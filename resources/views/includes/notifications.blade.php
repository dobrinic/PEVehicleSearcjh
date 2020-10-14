<?php

    $vars = Session::all();
    foreach ($vars as $key => $value) {
        switch($key) {
            case 'success':
            case 'error':
            case 'warning':
            case 'info':
                if($key == 'error')
                    $icon = 'fa-ban';
                if($key == 'success')
                    $icon = 'fa-check';
                if($key == 'warning')
                    $icon = 'fa-warning';
                if($key == 'info')
                    $icon = 'fa-info';
                ?>
                <div class="row" id="alert-box">
                    <div class="col-md-12">
                        <div class="alert alert-{{ $key=='error' ? 'danger' : $key }} alert-dismissible" data-auto-dismiss role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa {{ $icon ? $icon : '' }}"></i> {{ ucfirst($key) }}</h4>
                            {!! $value !!}
                        </div>
                    </div>
                </div>
                <?php
                Session::forget($key);
                break;
            default:
        }
    }

?>
