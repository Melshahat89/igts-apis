@extends(layoutExtend('website'))
@section('title')
    {{ trans('website.joinAsInstructor') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')

<section>
    <div class="bg_gradient joininstructor-bg">
        <div class=" parallax-section">
            <div class="parallax-image" data-parallax="parallax" data-parallax-bg-image="/images/front/parallax/join-us-hero.png" data-parallax-speed="0.6" data-parallax-direction="up"></div>
            <div class="parallax-content parallax-xpad">
                <div class="wrapper" style="padding-top: 80px;">
                    <div class="col-md-8 float-left">
                        <div class="card joininstructor-card ">
                            <div class="card-body ">
                                <p class="card-text joininstructor-card-text">{{ trans('website.Medical training and rehabilitation is our passion and the focus of our attention in IGTS Medical Department, through which we seek to communicate the useful knowledge and accumulated experiences of our highly qualified trainers and lecturers with abundant experience, and we are distinguished in the IGTS Medical Department by the dynamism and flexibility of training ideas and rehabilitation plans for the various groups benefiting from our services and we are working to recruit and harness the best Possibilities to communicate our programs and courses to learners and trainees.') }}</p>
                                <div class="actions text-center pt-4">
                                    <a href="#applynow" style="font-size: 18px;" class="button button_primary button_small text_capitalize" type="button" role="button">{{ trans('Join Us Now') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="pb-4 wrapper">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="pt-4 pb-4">
                <h2 class="text-center" style="color: #244092">{{ trans('website.Why Choose IGTS') }}</h2>
            </div>
        </div>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/BrAXHkfqqxk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</section>
<hr style="width: 50%;">

<section class="wrapper pt-4">

    <div class="row">
        <div class="col-md-12">
            <div class="pt-4 pb-4">
                <h2 class="text-center" style="color: #244092">{{ trans('website.The benefits of E-Learning on IGTS') }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-flush pb-4 {{ getDir() == 'ltr' ?  'text-right' : 'text-left' }}">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3>{{ trans('website.A great addition to your C.V') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 

                        <i class="fas fa-certificate"></i>
                        <p>{{ trans('website.HR managers are always looking for energetic employees who do different jobs to serve their communities') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Self-confidence') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-trophy"></i>
                        <p>{{ trans('website.When you see the positive interaction of the trainees with your distinguished courses, this will increase your self-confidence and thus increase your functional and social skills.') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Experience') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>{{ trans('website.By offering online courses, you prove your distinguished expertise in your field, and this is what human resource managers are looking for.') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Improve your performance') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-spinner"></i>
                        <p>{{ trans('website.When you see yourself in the educational videos in your online courses, your style as a professional trainer in communicating information improves automatically.') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Personal Fame') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-bullhorn"></i>
                        <p>{{ trans('website.Everyone who follows your online premium courses will always try to keep track of your news and additional skills.') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Inspiring the trainees') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-users"></i>
                        <p>{{ trans('website.Help the trainees hone their scientific and practical skills during your training courses, which will secure them a better life and thus be an effective element in your community.') }}</p>
                </li>
                <li class="list-group-item">
                    
                        <h3>{{ trans('website.Increase income') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> 
                        <i class="fas fa-dollar-sign"></i>
                        <p>{{ trans('website.Online courses are a great way to earn money... Premium courses bring in returns of thousands of dollars per month.') }}</p>
                </li>
                </ul>
            </ul>
        </div>

        <div class="col-md-6 pb-4">
            <ul class="list-group list-group-flush {{ getDir() == 'ltr' ? 'text-left' : 'text-right' }}">
                <ul class="list-group">
                <li class="list-group-item">
                    <i class="fas fa-laptop"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.Featured Tools') }}</h3>
                    <p>{{ trans('website.IGTS provides the tools needed to create courses and we will help you at every step of the way to create professional courses.') }}</p>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-align-justify"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.Multiple Course Types') }}</h3>
                    <p>{{ trans('website.IGTS offers multiple options for training courses such as crash courses, diplomas, masters and bundles.') }}</p>
                </li>
                <li class="list-group-item">
                    <i class="far fa-life-ring"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.Special Support') }}</h3>
                    <p>{{ trans('website.We offer you special support as a coach to help you become a professional coach through the IGTS website, so we are always in touch to provide the best for the trainees') }}</p>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-chalkboard"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.New Experience') }}</h3>
                    <p>{{ trans('website.Courses on IGTS offer you an exciting and distinct experience that is different from your previous experiences.') }}</p>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-hashtag"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.Social Publishing') }}</h3>
                    <p>{{ trans('website.IGTS provides you with tools to publish your courses through social media to increase the spread of your courses and thus increase the number of trainees.') }}</p>
                </li>
                <li class="list-group-item">
                    <i class="far fa-edit"></i>
                    <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('website.Learning Environment') }}</h3>
                    <p>{{ trans('website.IGTS provides trainers with an effective and flexible work environment to create training courses and exams quickly and simply.') }}</p>
                
                </ul>
            </ul>
        </div>
    </div>
</section>

<hr style="width: 50%;">

<section id="applynow" style="background-color: white;" class="pb-4">
    <div class="">
        <div class="col-md-12">
            <div class="pt-4 pb-4">
                <h2 class="text-center" style="color: #244092">{{ trans('website.Apply Now To Become an Instructor') }}</h2>
            </div>
        </div>
    </div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                <script>
                    hbspt.forms.create({
                    portalId: "7171341",
                    formId: "d8c9a560-f9f5-4c43-870e-ba1fbcb201ba"
                });
                </script>
            </div>
        </div>
    </div>
</section>


@endsection
@push('script')
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7171341.js"></script>
        <!-- End of HubSpot Embed Code -->
@endpush