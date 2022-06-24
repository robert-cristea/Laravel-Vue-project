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
        <h3 class="page-title">Concessionaires</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Concessionaires</a></li>
            <li class="breadcrumb-item"><a href="/admin/Concessionairess">List</a></li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h6>Add Concessionaire</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('concessionaires.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="help-block-error">(*)</span></label>
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{ old('name') }}"  required/>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="help-block-error">(*)</span><span style="padding-left:20px;">(ex. 0149076191)</span></label>
                            <input type="text" name="phone" pattern="\d{10,12}"  minlength="10"  maxlength="12" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" required />
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax <span class="help-block-error">(*)</span> <span style="padding-left:20px;">(ex. 77886102)</span></label>
                            <input type="text" name="fax" pattern="\d{8,10}" minlength="8" maxlength="10" class="form-control" placeholder="Fax" value="{{ old('fax') }}" required/>
                            @if ($errors->has('fax'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fax') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="reg_no">Registration Number</label>
                            <input type="text" name="reg_no" class="form-control" placeholder="Registration Number" value="{{ old('reg_no') }}" />
                            @if ($errors->has('reg_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('reg_no') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" class="form-control" placeholder="Website" value="{{ old('website') }}" />
                            @if ($errors->has('website'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email address <span class="help-block-error">(*)</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
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
                        <div class="form-group">
                            <label for="person_in_charge">Person In Charge</label> 
                            <input type="text" name="person_in_charge" class="form-control" placeholder="Person In Charge" value="{{ old('person_in_charge') }}" />
                            @if ($errors->has('person_in_charge'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('person_in_charge') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" style="background-color: #4fc47f; color: white;" class="btn btn-primary">Submit</button>
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