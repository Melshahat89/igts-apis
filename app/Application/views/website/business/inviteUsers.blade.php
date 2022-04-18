@extends(layoutBusiness())
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.Invite Users') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('businessdata.Invite Users') }}</h3>
        </div>

        <div class="panel-body">
            <form action="{{ concatenateLangToUrl('business/invite-bulk-users') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>{{ trans('businessdata.Enter User Email') }}</h4>
                           
                            <textarea name="emails" class="form-control" placeholder="{{ trans('businessdata.Add Email Or Group of Emails') }}    Ex: example1@gmail.com,example2@gmail.com" rows="4"></textarea>
                            <br>
                            <span class="control-fileupload">
                                <label for="fileInput">{{ trans('businessdata.Upload Your List') }}</label>
                                <input name="emailsfile" type="file" id="fileInput" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </span>
                            <input type="hidden" id="businessId" name="businessId" value="{{$businessdata->id}}">

                        </div>

                        <div class="pt-4">
                            <h4>{{ trans('businessdata.Select Group (Optional)') }}</h4>
                           
                            <select name="group_id" class="form-control">
                        <option value=""></option>
                        @isset($Groups)
                            @foreach ($Groups as $key => $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                            <br>
                           
                        </div>
                    </li>
                   
                    <li>
                        <span class="activity-icon">2</span>
                        <div>
                            <button type="submit" class="btn btn-primary txt-Upp mt-15">{{ trans('businessdata.Send Invitation') }}</button>
                        </div>
                    </li>

                </ul>
            </form>
        </div>
    </div>


    <!-- Generate Invitation URL -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('businessdata.Generate Invitation Link') }}</h3>
        </div>

        <div class="panel-body">
            <form action="{{ concatenateLangToUrl('business/invite-bulk-users') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="list-unstyled activity-timeline">
                    <li>
                        <span class="activity-icon">1</span>
                        <div>
                            <h4>{{ trans('businessdata.Select Group (Optional)') }}</h4>
                           
                            <select name="parent_id" id="generated_group_id" class="form-control" onchange="selectGroup()">
                        <option value=""></option>
                        @isset($Groups)
                            @foreach ($Groups as $key => $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                            <br>
                           
                        </div>
                    </li>

                    
                    <li>
                        <span class="activity-icon">2</span>
                        <div>
                            <h4>{{ trans('businessdata.Click on the link to copy it') }}</h4>
                           
                            <span class="form-control" id="generated_inv_url" onclick="copyInvLink()">
                               {{concatenateLangToUrl('business/invite/' . $businessdata->id .'/')}}
                            </span>
                            <br>
                           
                        </div>
                    </li>

                    <li>
                        <span class="activity-icon">3</span>
                        <div>
                            <h4>{{ trans('businessdata.Or Send this QR Code to your users') }}</h4>
                           
                                <img style="height: 200px;"  id="qrcode_img" src="{{$initQr}}">
                            <br>
                           
                        </div>
                    </li>

                    
                   

                </ul>
            </form>
        </div>
    </div>

@endsection

@push('js')

<script>

function selectGroup(){
    
    value = document.getElementById("generated_group_id").value;


    document.getElementById("generated_inv_url").innerHTML = "{{concatenateLangToUrl('business/invite/' . $businessdata->id .'/')}}" + '/' + value;

    generateQrAjax();
}

function copyInvLink(){
    
    invite_link = document.getElementById("generated_inv_url");

    const el = document.createElement('textarea');
    el.value = invite_link.innerHTML;
    document.body.appendChild(el);
    el.select();
    el.setSelectionRange(0, 99999); /* For mobile devices */

    document.execCommand("copy");
    document.body.removeChild(el);

    alert("The invitation link has been coppied to your clipboard");


}
</script>


<script>

function generateQrAjax(){

    invite_link = document.getElementById("generated_inv_url").innerHTML;

    $.ajax({
            url: "/generateQrCode?url=" + invite_link,
            type: "GET",

            success: function(data) {

                document.getElementById("qrcode_img").src = data.code;

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                console.log(thrownError);
            }
        });
}

</script>

@endpush