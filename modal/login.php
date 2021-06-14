<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <div class="pl-lg-5 pr-lg-5 pl-md-5 pr-md-5">
                        <div class="row p-4">
                            <div class="col-12 text-center mb-4">
                                <p class="login-title">Please login to continue</p>
                            </div>
                            <div class="col-12 text-center">
                                <p class="login-title display-4" style="color:#333">Login</p>
                            </div>
                            <?php /*
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center mb-2">
                                <!--<button type="button" class="btn facebook-btn btn-primary btn-block p-2"><i
                                        class="fab fa-facebook-square fa-2x"></i> <span
                                        class="center-word">Facebook</span></button>-->
                                        <?php include 'facebook_login.php';?>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center mb-2">
                                <!--<button type="button" class="btn google-btn bg-white btn-block p-2"><i
                                        class="fab fa-google fa-2x"></i> <span
                                        class="center-word">Google</span></button>-->
                                        <?php include 'google_login.php';?>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <p class="text-black text-large">Or</p>
                            </div>*/?>



                            <form action="" method="post" enctype="multipart/form-data" style="width:100%;">
                                <input type="hidden" name="action" value="signin">
                                <div class="col-12 text-center form-group">
                                    <input class="login-input form-control p-3" name="username" id="username"
                                        placeholder="Email Address"><!--type="email" -->
                                </div>
                                <div class="col-12 text-center form-group mb-5">
                                    <input type="password" class="login-input form-control p-3" id="password"
                                        name="password" placeholder="Password">
                                    <!--<small id="forget-password" class="form-text text-muted text-right">
                                        <div class="hyperlink" data-toggle="modal" data-target="#forgetPasswordModal" data-dismiss="modal" style="cursor:pointer;">Forget Password</div>
                                    </small>-->
                                    <small class="form-text text-muted text-right">
                                        <a href="https://wa.me/60168653947" target="_blank">
                                            <div class="d-inline" style="position:relative; top:3px;">
                                            Forget Password
                                            </div>
                                            <img src="<?php echo ROOT?>images/whatsapp-lightorange.svg" width="18px" style="margin-left:10px;"> 
                                        </a>
                                    </small>

                                </div>
                                <div class="col-12 text-center form-group">
                                    <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default">
                                        <i class="fas fa-user"></i>
                                        <span class="center-word">LOGIN</span>
                                    </button>
                                </div>
                            </form>
                            <div class="col-12 text-center create-account form-group">
                                <a href="signup">Create Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>