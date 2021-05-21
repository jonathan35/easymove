<div id="forgetPasswordModal" class="modal fade" role="dialog">
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
                                <p class="login-title" style="font-size:150%;">Forgot your password?</p>
                            </div>
                   
                            <form action="" method="post" enctype="multipart/form-data" style="width:100%;">
                                <input type="hidden" name="action" value="reset_password">                        
                                <div class="col-12 form-group">
                                    <label class="email edit-input-label" for="new-email">Email Address</label>
                                    <input type="email" class="login-input form-control p-3" name="email" id="email" placeholder="Email Address">
                                </div>
                                <div class="col-12 text-center form-group">
                                    <button type="submit" value="submit" class="btn btn-block p-3 btn-default">
                                        <i class="fas fa-user"></i>
                                        <span class="center-word">SEND</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>