@extends("layouts.user")

@section("title") PAN Card Application @endsection

@section("custom_css")
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
@endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header with-border text-center">
            <h1 class="box-title">Apply new PAN Card (Form 94A)</h1>
        </div>

        <div class="box-body">
            @include("includes.errors")
            @if(isset($pan_id))
                <div class="alert alert-success">
                    PAN Card application received. <a href="/pans/receipt/{{ $pan_id }}">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </a>
                </div>
            @endif
            <form method="POST" action="/pans" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-3">
                        <b>Apply PAN Card:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="radio" id="newPan" onclick="removePAN();"checked> New
                            </div>

                            <div class="col-sm-6">
                                <input type="radio" onclick="addPAN();" id="updatePan"> Update / Correction
                            </div>
                        </div>
                    </div>
                    <br/><br/>

                    <div id="hiddenPan" style="display: none">
                        <div class="col-sm-3">
                            <b>PAN Number:</b>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" name="pan_number" placeholder="Enter PAN Number"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Category of Applicant:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="category" class="form-control">
                                        <option value="">Please Select</option>
                                        <option value="Individual">Individual</option>
                                        <option value="Company">Company</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="date" value="{{ \Carbon\Carbon::now()->toFormattedDateString() }}"
                                           class="form-control" placeholder="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Applicant's Name:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="first_name" placeholder="First Name"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="middle_name" placeholder="Middle Name"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="last_name" placeholder="Last Name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Name of Card:</b>
                    </div>
                    <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" name="card_name" placeholder="Name of Card"
                                           class="form-control">
                                </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Father's Name:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="father_first_name" placeholder="First Name"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="father_middle_name" placeholder="Middle Name"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="father_last_name" placeholder="Last Name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Date of Birth:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" name="dob"
                                               placeholder="Date of birth">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Contact Details:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" value="091" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" name="mobile" placeholder="Mobile Number"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Email Address:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Email Address" value="{{ Auth::user()->email }}"
                                   class="form-control" name="email">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Address:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="C/O, S/O, D/O, W/O"
                                   class="form-control" name="c_o">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Flat/Room/Door/Block No."
                                   class="form-control" name="flat">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Name of Premises/Building/Village"
                                   class="form-control" name="premises">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Road/Street/Lane/Post Office"
                                   class="form-control" name="road">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Area/Locality/Taluka/Sub-Devision"
                                   class="form-control" name="area">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Town/City/District"
                                   class="form-control" name="city">
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" placeholder="Area PIN Code"
                                           class="form-control" name="area_pin">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" placeholder="Country"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Adhar No:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Adhar Number" name="adhar_number"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="file" name="adhar_proof" class="form-control" placeholder="Upload Adhar Card Proof"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Proof of Identity:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select name="identity_proof" class="form-control" required>
                                <option value="">Please Select</option>
                                <option>Aadhaar Card issued by the Unique Identification Authority of India</option>
                                <option>Elector photo identity card</option>
                                <option>Passport</option>
                                <option>Ration card having photograph of the applicant</option>
                                <option>Arm's license</option>
                                <option>Photo identity card issued by the Central Government or State Government or Public Sector Undertaking</option>
                                <option>Pensioner card having photograph of the applicant</option>
                                <option>Central Government Health Service Scheme Card or Ex-Servicemen Contributory Health Scheme photo card</option>
                                <option>Certificate of identity in Original signedby a Member of Parliament or Member of Legislative Assembly or Municipal Councilor or a Gazetted officer, as the case may be</option>
                                <option>Bank certificate in Original on letter head from the branch(alongwith name and stamp of the issuing officer) containing duly attested photograph and bank account number of the applicant</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Proof of Address:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select name="address_proof" class="form-control" required>
                                <option value="">Please Select</option>
                                <option>Aadhaar Card issued by the Unique Identification Authority of India</option>
                                <option>Elector's photo identity card</option>
                                <option>Driving License</option>
                                <option>Passport</option>
                                <option>Passport of the spouse</option>
                                <option>Post office passbook having address of the applicant</option>
                                <option>Latest property tax assessment order</option>
                                <option>Domicile certificate issued by the Government</option>
                                <option>Allotment letter of accommodation issued by Central or State Government of not more than three years old</option>
                                <option>Property Registration Document</option>
                                <option>Electricity Bill</option>
                                <option>Latest Property Tax Assessment Order</option>
                                <option>Electricity Bill</option>
                                <option>Landline Telephone or Broadband connection bill</option>
                                <option>Water Bill</option>
                                <option>Consumer gas connection card or book or piped gas bill</option>
                                <option>Bank account statement or as per Note 2</option>
                                <option>Depository account statement</option>
                                <option>Credit card statement</option>
                                <option>Certificate of address in Original signed by a Member of Parliament or Member of Legislative Assembly or Municipal Councilor or a Gazetted officer, as the case may be</option>
                                <option>Employer certificate in original</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>Proof of Date of Birth:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select name="dob_proof" class="form-control" required>
                                <option value="">Please Select</option>
                                <option>Aadhaar Card issued by the Unique Identification Authority of India</option>
                                <option>Elector's photo identity card</option>
                                <option>Driving License</option>
                                <option>Passport</option>
                                <option>Matriculation Certificate or Mark Sheet of recognized board</option>
                                <option>Birth Certificate issued by the Municipal Authority or any office authorized to issue Birth and Death Certificate by the Registrar of Birth and Death or the
                                    Indian Consulate as defined in clause (d) of sub-section (1) of section 2 of the Citizenship Act, 1955 (57 of1955)</option>
                                <option>Photo identity card issued by the Central Government or State Government or Public Sector Undertaking or State Public Sector Undertaking</option>
                                <option>Domicile Certificate issued by the Government</option>
                                <option>Central Government Health Service Scheme photo Card or Ex-Servicemen Contributory Health Scheme photo card</option>
                                <option>Pension payment order</option>
                                <option>Marriage certificate issued by Registrar of Marriages</option>
                                <option>Affidavit sworn before a magistrate stating the date of birth</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <b>PIN Number:</b>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number" placeholder="Enter PIN Number" name="pin"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" value="Proccessing Fee: Rs. {{ env("PROCESSING_FEE") }} With GST"
                                           class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                Apply pan card
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <script src="/css/iCheck/icheck.min.js"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });

        function addPAN() {
            $(".box-title").html("PAN Update/Correction/Reprint Form");
            $('#newPan').prop('checked',false);
            $("#hiddenPan").fadeIn(400).show();
        }

        function removePAN() {
            $(".box-title").html("Apply new PAN Card (Form 94A)");
            $('#updatePan').prop('checked',false);
            $("#hiddenPan").fadeOut(600).hide();
        }
    </script>
@endsection