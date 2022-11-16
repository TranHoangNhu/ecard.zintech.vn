<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51" style="background-color:#fff !important;">
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div style="text-align: center !important; padding-top: 20px;">
                            <img src="https://scontent.fsgn19-1.fna.fbcdn.net/v/t1.6435-9/65082816_103000570998027_3240082388474134528_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=d6bfXbMuAucAX9sG_iw&_nc_ht=scontent.fsgn19-1.fna&oh=00_AfC4DUdGteFtztrA-0yelbaOFK7tuJMuv6jzggemu_selg&oe=63831DC1" alt="Admin"
                                    class="rounded-circle p-1 bg-primary" width="120">
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="far fa-user fs-5 me-3 text-warning"></i>Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="tenkh" value="<?=$tenkh?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="far fa-envelope fs-5 me-3 text-warning"></i>Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="email" value="<?=$email?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-phone fs-5 me-3 text-warning"></i>Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="dienthoai" value="<?=$dienthoai?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-mobile-alt fs-5 me-3 text-warning"></i>Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="didong" value="<?=$didong?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-map-marker-alt fs-5 me-3 text-warning"></i>Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="diachi" value="<?=$diachi?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-home fs-5 me-3 text-warning"></i>Company</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="congty" value="<?=$congty?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="far fa-building fs-5 me-3 text-warning"></i>Department</h6> 
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="bophan" value="<?=$bophan?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-crosshairs fs-5 me-3 text-warning"></i>Position</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="chucvu" value="<?=$chucvu?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-globe fs-5 me-3 text-warning"></i>Website 1</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="website1" value="<?=$website1?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2">
                                    <h6 class="mb-0 fw-bold text-muted"><i class="fas fa-globe fs-5 me-3 text-warning"></i>Website 2</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="website2" value="<?=$website2?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 mb-2"></div>
                                <div class="col-sm-9 text-secondary">
                                    <div id="app">
                                        <div id="card">
                                            <div id="overlay"></div>
                                            <div id="qr-code"></div>
                                        </div>

                                        <div id="form-card"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">   
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="button" class="btn btn-primary px-4" value="Save Changes">
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3 p-3 fs-1 fw-bold justify-content-center">PROJECT STATUS</h5>
                                    <p>Web Design</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Website Markup</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%"
                                            aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>One Page</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 89%"
                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Mobile Template</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%"
                                            aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Backend API</p>
                                    <div class="progress" style="height: 5px">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%"
                                            aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <a id="back-to-top" class="btn btn-primary text-white" style="bottom: 40px; right: 30px; padding: 13px 17px 13px 13px;"><i class="fas fa-plus" style="padding: 8px 0 0 5px;"></i></a>
    
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"
      integrity="sha512-VKjwFVu/mmKGk0Z0BxgDzmn10e590qk3ou/jkmRugAkSTMSIRkd4nEnk+n7r5WBbJquusQEQjBidrBD3IQQISQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js"
      integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="js/qr/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="js/qr/script.js" defer></script>
    <!-- js profile -->
    <script src="js/profile.js"></script>
</body>