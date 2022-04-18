@php $courses = App\Application\Model\Courses::where("id" ,$courses_id)->first()  @endphp
{{$courses->title_lang}}