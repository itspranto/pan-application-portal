@extends("layouts.guest")

@section("title") Apply Online @endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary" style="margin-top: 40px">
                    <div class="box-header with-border text-center">
                        <h1 class="box-title">Apply for an account</h1>
                    </div>
                    <div class="box-body">
                        @if (isset($registration) && $registration == "success")
                            <div class="alert alert-success">
                                Registration was successful! Please wait till an Admin approves your account, you will
                                receive an email upon approval. Thank you.
                            </div>
                        @endif

                        @include("includes.errors")
                        <form method="POST" action="/register" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="page-header">Personal Details</h4>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                                               required/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                               placeholder="Email Address" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Password" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Confirm Password" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" placeholder="Address"
                                               required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="city" class="form-control" placeholder="City"
                                               required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="state" class="form-control" required>
                                            <option value="">Select State</option>
                                            <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                            <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                            <option value="ASSAM">ASSAM</option>
                                            <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                            <option value="GUJRAT">GUJRAT</option>
                                            <option value="BIHAR">BIHAR</option>
                                            <option value="HARYANA">HARYANA</option>
                                            <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                            <option value="JAMMU KASHMIR">JAMMU &amp; KASHMIR</option>
                                            <option value="KARNATAKA">KARNATAKA</option>
                                            <option value="KERALA">KERALA</option>
                                            <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                            <option value="MAHARASHTRA">MAHARASHTRA</option>
                                            <option value="MANIPUR">MANIPUR</option>
                                            <option value="MEGHALAYA">MEGHALAYA</option>
                                            <option value="MIZORAM">MIZORAM</option>
                                            <option value="NAGALAND">NAGALAND</option>
                                            <option value="ORISSA">ORISSA</option>
                                            <option value="PUNJAB">PUNJAB</option>
                                            <option value="RAJASTHAN">RAJASTHAN</option>
                                            <option value="SIKKIM">SIKKIM</option>
                                            <option value="TAMIL NADU">TAMIL NADU</option>
                                            <option value="TELANGANA">TELANGANA</option>
                                            <option value="TRIPURA">TRIPURA</option>
                                            <option value="WEST BENGAL">WEST BENGAL</option>
                                            <option value="DELHI">DELHI</option>
                                            <option value="GOA">GOA</option>
                                            <option value="PONDICHERY">PONDICHERY</option>
                                            <option value="LAKSHDWEEP">LAKSHDWEEP</option>
                                            <option value="DAMAN DIU">DAMAN &amp; DIU</option>
                                            <option value="DADRA NAGAR">DADRA &amp; NAGAR</option>
                                            <option value="CHANDIGARH">CHANDIGARH</option>
                                            <option value="ANDAMAN NICOBAR">ANDAMAN &amp; NICOBAR</option>
                                            <option value="UTTARANCHAL">UTTARANCHAL</option>
                                            <option value="JHARKHAND">JHARKHAND</option>
                                            <option value="CHATTISGARH">CHATTISGARH</option>
                                            <option value="MUMBAI">MUMBAI</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="country" class="form-control" required>
                                            <option value="IN" selected>India</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="number" name="pin" class="form-control" placeholder="PIN Code"
                                               required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control"
                                               placeholder="Mobile Number" required/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h4 class="page-header">Business Details</h4>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="shop" class="form-control"
                                               placeholder="Retailer shop name" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="landline" class="form-control"
                                               placeholder="Landline Number with STD (Optional)"/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="franchise" class="form-control"
                                               placeholder="Franchise Location" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="business" class="form-control"
                                               placeholder="Current Business" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="pan_number" class="form-control"
                                               placeholder="PAN Card Number" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="adhar_number" class="form-control"
                                               placeholder="Adhar Number (12 Digits not starting from 0)" required/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h4 class="page-header">Upload Documents</h4>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="photograph">Upload Photograph (JPEG 300 DPI)</label>
                                        <input type="file" name="photograph" class="form-control" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="signature">Upload Signature (JPEG 300 DPI)</label>
                                        <input type="file" name="signature" class="form-control" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="adhar_card">Upload Adhar Card (PDF 300 DPI)</label>
                                        <input type="file" name="adhar_card" class="form-control" required/>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pan_card">Upload PAN Card (PDF 300 DPI)</label>
                                        <input type="file" name="pan_card" class="form-control" required/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Apply</button>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="alert alert-info">
                                        <h4><i class="icon fa fa-info-circle"></i> Need assistance?</h4>
                                        <p>Call +91-11-221133445</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
