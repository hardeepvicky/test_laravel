<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\BaseModel;
use App\Models\SqlLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Helpers\FileUtility;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function delete(BaseModel | Model $model)
    {
        DB::beginTransaction();

        try
        {
            foreach($model->child_model_class as $className => $arr)
            {
                $child_model = new $className;

                if ($arr['preventDelete'])
                {
                    $count = $child_model->where($arr['foreignKey'], "=", $model->id)->count();

                    if ($count > 0)
                    {
                        throw_exception("Record has associated data in $className. can't delete");
                    }
                }
                else
                {
                    $list = $child_model->where($arr['foreignKey'], "=", $model->id)->pluck("id");

                    if ($list->count() > 0)
                    {
                        $list = $list->toArray();

                        if ( !$child_model->destroy($list) )
                        {
                            throw_exception("Fail to delete records of $className");
                        }
                    }
                }
            }

            if ( !$model->delete() )
            {
                throw_exception("Fail to delete record");
            }

            DB::commit();

            return true;
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
            throw $ex;
        }
    }

    protected function saveSqlLog()
    {
        if (App::environment('production')) 
        {
            return false;
        }

        $db_logs = DB::getQueryLog();

        if (count($db_logs) == 0)
        {
            return false;
        }

        $sqlLogModel = new SqlLog();

        $sqlLogModel->route_name_or_url = Route::getCurrentRoute()->getName();

        if (!$sqlLogModel->route_name_or_url)
        {
            $sqlLogModel->route_name_or_url = request()->getRequestUri();
        }

        $sqlLogModel->have_dml_query = false;
        $sqlLogModel->have_heavy_query = false;
       
        if ( !$sqlLogModel->saveQuietly() )
        {
            throw_exception("Fail to Save Sql Log");
        }

        $sql_list = $dml_sql_list = [
            implode(",", ["Query", "Time-In-MilliSeconds"])
        ];

        foreach ($db_logs as $row)
        {
            $is_dml = false;

            $query = $row['query'];

            $query = vsprintf(str_replace('?', '%s', $query), $row['bindings']);

            $query = trim(preg_replace('/\s+/', ' ', $query));
            
            $sql_row = implode(",", [$query, $row["time"]]);

            $sql_list[] = $sql_row;

            $query_first_10_chars = substr($query, 0, 10);
            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "INSERT") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "insert") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "UPDATE") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "update") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "DELETE") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "delete") !== false;
            }

            if ($is_dml)
            {
                $sqlLogModel->have_dml_query = true;

                $dml_sql_list[] = $sql_row;
            }

            if ($row["time"] > 1000)
            {
                $sqlLogModel->have_heavy_query = true;
            }
        }

        $path = SqlLog::getFileSavePath() . $sqlLogModel->id . "/";
        FileUtility::createFolder($path);

        $sqlLogModel->sql_log_file = $path . "sql.txt";

        $content = implode(PHP_EOL, $sql_list);
        file_put_contents($sqlLogModel->sql_log_file, $content);

        if ($sqlLogModel->have_dml_query)
        {
            $sqlLogModel->sql_dml_log_file = $path . "sql_dml.txt";
            $content = implode(PHP_EOL, $dml_sql_list);
            file_put_contents($sqlLogModel->sql_dml_log_file, $content);
        }

        if ( !$sqlLogModel->saveQuietly() )
        {
            throw_exception("Fail to Save Sql Log");
        }

        return true;
    }
}
