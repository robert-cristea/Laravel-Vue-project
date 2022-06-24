@extends('admin.layouts.layout-horizontal')

@section('styles')
<style>
.invalid-feedback {
    display: block !important;
}
</style>
@endsection

@section('content')
<div class="main-content contact-page">
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Assessor</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Assessor</a></li>
            <li class="breadcrumb-item"><a href="/admin/auditors">List</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    @if($auditor->ad_username!="")
                    <h6>Edit AD Assessor</h6>
                    @else
                    <h6>Edit Assessor</h6>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('auditors.update', $auditor->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name<span class="help-block-error">(*)</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $auditor->name) }}" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number<span class="help-block-error">(*)</span>(ex: 0149076191)</label>
                            <input type="text" name="phone" pattern="\d{10,12}"  minlength="10"  maxlength="12" class="form-control" placeholder="Phone Number" value="{{ old('phone', $auditor->phone) }}" />
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax<span class="help-block-error">(*)</span>(ex: 77886102)</label>
                            <input type="text" name="fax" pattern="\d{8,10}" minlength="8" maxlength="10"  class="form-control" placeholder="Fax" value="{{ old('fax', $auditor->fax) }}" />
                            @if ($errors->has('fax'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fax') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span class="help-block-error">(*)</span></label>
                            <textarea name="address" class="form-control" placeholder="Address">{{ old('address', $auditor->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email address<span class="help-block-error">(*)</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email', $auditor->email) }}" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($auditor->ad_username=="")
                        <div class="form-group">
                            <label for="password">Password</label> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <div id="pass_err"></div>
                                </div>
                                <div class="col-sm-6">
                                <button type="button" style="background-color: #F35A3D; color: white; border:0" id="passgenenator_btn" class="btn btn-primary">Generate Password</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- <div class="form-group">
                            <label for="status">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="ASSIGNED" id="ASSIGNED" class="form-check-input" {{ $auditor->user_auditor ? ($auditor->user_auditor->status == 'ASSIGNED' ? 'checked' : '') : '' }} /> 
                                    <label for="ASSIGNED" class="form-check-label">ASSIGNED</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="SUBMITTED" id="SUBMITTED" class="form-check-input" {{ $auditor->user_auditor ? ($auditor->user_auditor->status == 'SUBMITTED' ? 'checked' : '') : '' }} /> 
                                    <label for="SUBMITTED" class="form-check-label">SUBMITTED</label>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div> --}}

                        @if($auditor->ad_username=="")
                        <input type="hidden" name="send_email" id="send_email" value="0">
                        <button type="submit" style="background-color: #007DCC; color: white; margin-right: 60px;" class="btn btn-primary" id="send_email_btn">Save & Send Login Credentials</button>
                        @endif

                        <button type="submit" style="background-color: #4fc47f; color: white;" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Generating Character Codes For The Application
    const UPPERCASE_CODES = arrayFromLowToHigh(65, 90);
    const LOWERCASE_CODES = arrayFromLowToHigh(97, 122);
    const NUMBER_CODES = arrayFromLowToHigh(48, 57);
    const SYMBOL_CODES = arrayFromLowToHigh(33, 47)
    .concat(arrayFromLowToHigh(58, 64))
    .concat(arrayFromLowToHigh(91, 96))
    .concat(arrayFromLowToHigh(123, 126));

    // Character Code Generating Function
    function arrayFromLowToHigh(low, high) {
    const array = [];
    for (let i = low; i <= high; i++) {
        array.push(i);
    }
    return array;
    }

    // The Password Generating Function
    let generatePassword = (
    characterAmount,
    includeUppercase,
    includeNumbers,
    includeSymbols
    ) => {
    let charCodes = LOWERCASE_CODES;
    if (includeUppercase) charCodes = charCodes.concat(UPPERCASE_CODES);
    if (includeSymbols) charCodes = charCodes.concat(SYMBOL_CODES);
    if (includeNumbers) charCodes = charCodes.concat(NUMBER_CODES);
    const passwordCharacters = [];
    for (let i = 0; i < characterAmount; i++) {
        const characterCode =
        charCodes[Math.floor(Math.random() * charCodes.length)];
        passwordCharacters.push(String.fromCharCode(characterCode));
    }
    return passwordCharacters.join("");
    };

    document.getElementById("passgenenator_btn").addEventListener("click", (e) => {
   
    const characterAmount = 10;
    const includeUppercase = true;
    const includeNumbers = true;
    const includeSymbols = true;
    const password = generatePassword(
        characterAmount,
        includeUppercase,
        includeNumbers,
        includeSymbols
    ); 
    
    document.getElementById("password").value = password;

    //Copy the password in clipboard
    const textarea = document.createElement("textarea");
    textarea.value = password;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    textarea.remove();

    });

    document.getElementById("send_email_btn").addEventListener("click", (e) => {
        document.getElementById("pass_err").innerHTML= '';
        if(document.getElementById("password").value==""){
            e.preventDefault();
            document.getElementById("pass_err").innerHTML= '<span role="alert" class="invalid-feedback"><strong>The password field is required.</strong></span>';
        }
        document.getElementById("send_email").value=1;
    });
</script>
@endsection