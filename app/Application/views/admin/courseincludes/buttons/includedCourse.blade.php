@php $courses = App\Application\Model\Courses::where("id" ,$included_course)->first()  @endphp
{{$courses->title_lang}}