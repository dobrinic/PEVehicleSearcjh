<?php

    $vars = Session::all();
    foreach ($vars as $key => $value) {
        switch($key) {
            case 'success':
            case 'error':
            ?>
                <div class="container">
                    <div class="row" id="alert-box">
                        <div class="col-md-12">
                            <div class="alert alert-{{ $key!=='success' ? 'danger' : $key }} alert-dismissible" data-auto-dismiss role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!! $value !!}
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;
            case 'errors':
            ?>
                <div class="container">
                    <div class="row" id="alert-box">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible" data-auto-dismiss role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php
                                    foreach ($errors->all() as $error) {
                                       ?>
                                       <p> {{ $error }}</p>
                                       <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;
            default:
        }
        Session::forget($key);
    }

?>
