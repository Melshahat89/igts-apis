 
<button type="button" class="close_modal" data-dismiss="modal" aria-label="Close"></button>
<?php

use App\Application\Model\Certificates;
use App\Application\Model\Courses;
use Illuminate\Support\Facades\Auth;

$enrolled = Courses::isEnrolledCourse($course->id); ?>

<div class="pbxs plmd prmd bg_white rounded_6">
    <div class="text_center">
        <!--// Certificates-->
        <section class="sec sec_pad_bottom_sm" id="nav_course_cirtificate" style="display: block;">
            <section class="title mbmd">
                <h2 class="text_primary text_capitalize">{{trans('certificates.accreditations')}}</h2>
            </section>

            <section class="sec sec_pad_top_sm sec_pad_bottom_sm bg_lightergray" >
                <div class="wrapper">
                    <div class="certified_certificates">
                        <form class="popup-cert-form" id="certificatescontainer" name="" method="get" action="" style="display: block;width: 100%">
                            <input type="hidden" name="course_id" value="<?php echo $course->id; ?>">

                            <div>

                                {{-- <p>{{trans('certificates.description')}}</p> --}}
                                    <br>
                                    <p>{{trans('certificates.to request exta accreditations')}}</p>
                                <section class="title mbmd">
                                    <h2 class="text_primary text_capitalize certificates-container-h2"> <i class="fas text_muted  fa-file-word"></i>  &nbsp; {{trans('certificates.additional accreditations')}}</h2>
                                </section>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{trans('certificates.certificate name')}}</th>
                                            <th>{{trans('certificates.certificate fees')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach ($course->certificatescontainer as $certificatecontainer) { ?>
                                            <tr>
                                                <td>
                                                    <label class="checkbox ">
                                                        <?php // $isPassed = Quiz::isPassed($model->id); ?>
                                                        <?php echo $certificatecontainer->certificate->title_lang; ?>
                                                        <?php if (!Certificates::isBoughtCertificate($course->id, $certificatecontainer->certificate->id)) { // $isPassed &&  ?>
                                                            <input type="checkbox" name="Certificates[]" value="<?php echo $certificatecontainer->certificate->id; ?>" class="certificate_item popup" required>
                                                            <span class="checkmark"></span>
                                                        <?php } ?>
                                                    </label>
                                                </td>
                                                <td><?php echo getCurrency(); ?> <?php echo number_format($certificatecontainer->certificate->price); ?></td>
                                            </tr>


                                        <?php } ?>
                                        
                                        {{--<tr>
                                            <td>
                                                <div class="">
                                                    <div class="">
                                                        <i class="fas fa-info-circle"></i>
                                                        {{trans('certificates.certificates shipping 1')}}

                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="">
                                                        <i class="fas fa-info-circle"></i>
                                                        {{trans('certificates.certificates shipping 2')}}

                                                    </div>
                                                </div>

                                            </td>
                                            <td></td>
                                        </tr>--}}
                                    </tbody>


                                </table>

                            </div>

                            <div>

                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <div class="mtlg">
                                                <?php if (Auth::check()) { ?>
                                                    <?php if (!$allCertBought) { ?>
                                                        <section class="title mbmd">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                    <button type="submit" onclick="addCertToCart();" class="add_certificates_to_cart button button_primary_reverse text_capitalize">{{trans('certificates.add certificates to cart')}}</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="/courses/addToCart/id/{{$course->id}}" class="go_to_cart button button_primary_reverse text_capitalize">{{trans('certificates.continue payment')}}</a>
                                                                </div>
                                                            </div>

                                                        </section>

                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <section class="title mbmd">
                                                        <button type="button" data-dismiss="modal" data-remote="/login" data-toggle="ajaxModal" class="button button_primary_reverse text_capitalize" >تسجيل الدخول</button>
                                                    </section>
                                                <?php } ?>


                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </form>


                    </div>
                </div>
                <?php if ($allCertBought) { ?>
                    <div class="wrapper">
                        <div class="alert certificate_alert">
                            <i class="fas fa-info-circle"></i>تم شراء جميع الشهادات الخاصة بهذه الدورة
                        </div>
                    </div>
                <?php } ?>


                <div class="wrapper" style="display:none;">
                    <div class="alert certificate_alert">
                        <i class="fas fa-info-circle"></i>

                        متاح تصديق الشهادات الأمريكية من (وزارة الخارجية الامريكية + كاتب العدل + حاكم الولاية الامريكية )و تصديقها ايضا من السفارات المختلفة برسوم اضافية و تكاليف الإرسال برسوم اضافية
                        ....
                        لتفاصيل اكتر اضغط على
                            <a href="https://api.whatsapp.com/send?phone=201022603995&text=استفسار عن الشهادات من الموقع" class="social_link" style="    position: relative; top: 5px;left: 2%;"><i class="fab fa-whatsapp"></i></a>

                    </div>
                </div>
            </section>
        </section>
    </div>

</div>