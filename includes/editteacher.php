<!-- The Modal -->
<div class="modal" id="editteacher">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Teacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Full Name <span class="red">*</span></label>
                                <div class="col-sm-8"> <input type="text" name="fname" id="full-name" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8"> <input type="email" name="femail" id="email" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Phone No. <span class="red">*</span></label>
                                <div class="col-sm-8"> <input type="number" name="fphone" id="phone" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Qualification</label>
                                <div class="col-sm-8"> <input type="text" name="fqualification" id="qualification" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Speciality <span class="red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="speciality" id="fspeciality" class="form-control">
                                        <option value="" selected="selected" disabled>Select Speciality</option>
                                        <option value="PRT">PRT</option>
                                        <option value="TGT">TGT</option>
                                        <option value="PGT">PGT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8"> <input type="text" name="fdescription" id="description" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Joining Date</label>
                                <div class="col-sm-8"> <input type="text" name="fjoining-date" id="joining-date" class="form-control"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3"> <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10"><textarea class="form-control" name="faddress" id="address" style="height: 100px" data-gramm="false" wt-ignore-input="true"></textarea></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" name="updatedata"> Update Teacher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>