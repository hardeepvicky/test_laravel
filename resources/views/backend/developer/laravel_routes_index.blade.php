@extends($layout)

@section('content')

<?php
    $page_header_links = [
        
    ];
?>

@include($common_elements_path . ".page_header")

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover i-data-table">
            <thead>
                <tr>
                    <th style="width:150px;" data-sort="numeric">#</th>
                    <th data-search="1" data-sort="text">URL</th>
                    <th data-search="1">Route Name</th>
                    <th data-search="1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach($routes as $route):
                    $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $route['url'] ?></td>
                    <td><?= $route['route_name'] ?></td>
                    <td><?= $route['action'] ?></td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        
    </div>
</div>

@endsection