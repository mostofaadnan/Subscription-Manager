
@extends('FrontEnd.master')
@section('content')
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Neuer Kunde Formular</div>
            </div>
            <div class="panel-body" >

            <div class="result">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                </div>
                <form  class="form-horizontal" action="{{route('newClientSave')}}" method="POST">
                        @csrf
                        <div id="div_id_username" class="form-group required">
                            <label for="id_username" class="control-label col-md-4  requiredField">Firmenname<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" maxlength="30" name="company_name" placeholder="Choose your Company Name" style="margin-bottom: 10px" type="text" required/>
                                @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div id="div_id_username" class="form-group required">
                            <label for="id_username" class="control-label col-md-4  requiredField">Vollständiger Name<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" maxlength="30" name="full_name" placeholder="Choose your Full Name" style="margin-bottom: 10px" type="text"  required/>
                                @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                           
                            </div>
                           
                        </div>
                        <div id="div_id_email" class="form-group required">
                            <label for="id_email" class="control-label col-md-4  requiredField">E-mail<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md emailinput form-control" name="email" placeholder="Your current email address" style="margin-bottom: 10px" type="email" required />
                                @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                          
                        </div>

                        <div id="div_id_name" class="form-group required">
                            <label for="id_name" class="control-label col-md-4  requiredField">Telefonnummer<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control" name="phone" placeholder="Choose your Phone" style="margin-bottom: 10px" type="number" required/>
                                @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            
                        </div>
                        <div id="div_id_company" class="form-group required">
                            <label for="id_company" class="control-label col-md-4  requiredField">Stadt<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                 <input class="input-md textinput textInput form-control"  name="city" placeholder="Choose your City" style="margin-bottom: 10px" type="text" required />
                                 @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                           
                        </div>
                        <div id="div_id_catagory" class="form-group required">
                            <label for="id_catagory" class="control-label col-md-4  requiredField">Postleitzahl<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                 <input class="input-md textinput textInput form-control"  name="post_code" placeholder="Choose your Postal Code" style="margin-bottom: 10px" type="text" required />
                                 @error('post_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                         
                        </div>
                        <div id="div_id_number" class="form-group required">
                             <label for="id_number" class="control-label col-md-4  requiredField">Telegram Bot Name<span class="asteriskField">*</span> </label>
                             <div class="controls col-md-8 ">
                                 <input class="input-md textinput textInput form-control"  name="instance_name" placeholder="provide your Instance Name" style="margin-bottom: 10px" type="text" required/>
                            </div>
                        </div>
                        <div id="div_id_location" class="form-group required">
                            <label for="id_location" class="control-label col-md-4  requiredField">Adresse<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control"  name="address" placeholder="Your Address" style="margin-bottom: 10px" type="text" required/>
                                @error('address')
                              <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            </div>
                          
                        </div>

                        <div class="form-group">
                            <div class="aab controls col-md-4 "></div>
                            <div class="controls col-md-8 ">
                                <input type="submit" name="Signup" value="Anfrage abschicken" class="btn btn-primary btn btn-info" id="submit-id-signup" />

                            </div>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function() {

var enrollType;
//  $("#div_id_As").hide();
$("input[name='As']").change(function() {
    memberType = $("input[name='select']:checked").val();
    providerType = $("input[name='As']:checked").val();
    toggleIndividInfo();
});

$("input[name='select']").change(function() {
    memberType = $("input[name='select']:checked").val();
    toggleIndividInfo();
    toggleLearnerTrainer();
});

function toggleLearnerTrainer() {

if (memberType == 'P' || enrollType=='company') {
    $("#cityField").hide();
    $("#providerType").show();
    $(".provider").show();
    $(".locationField").show();
    if(enrollType=='INSTITUTE'){
        $(".individ").hide();
    }

}
else {
    $("#providerType").hide();
    $(".provider").hide();
    $('#name').show();
    $("#cityField").hide();
    $(".locationField").show();
    $("#instituteName").hide();
    $("#cityField").show();

}
}
function toggleIndividInfo(){

if(((typeof memberType!=='undefined' && memberType == 'TRAINER')||enrollType=='INSTITUTE') && providerType=='INDIVIDUAL'){
    $("#instituteName").hide();
    $(".individ").show();
    $('#name').show();
}
else if((typeof memberType!=='undefined' && memberType == 'TRAINER')|| enrollType=='INSTITUTE'){
    $('#name').hide();
    $("#instituteName").show();
    $(".individ").hide();
}
}

});


</script>
@endsection
