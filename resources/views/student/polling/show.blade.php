@extends('surveylayout')

@section('content')

<div class="card">
{{--    <form action="" class="space-y-8 divide-y divide-gray-200 mt-14">--}}
    {{ Form::open(['route' => ['submit_student_polling', $pollingStudent->uuid]]) }}
        <div class="space-y-2 mt-14">
            <div>
                <div class="card-title">
                    <h3 class="text-xl leading-6 font-bold text-center text-gray-900">
                        {{ $polling->survey_title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {!! $polling->description !!}
                    </p>
                </div>
            </div>

            <h2 class="font-bold text-center">Polling</h2>
            <p class="mt-1 text-md text-gray-700 text-center">Please select your desired option based on the question/questions posted:</p>
            <div class="card-body ml-5">
            @foreach($polling->polling_questions as $question)

                @if($question->question_type == 'scale')
                    <div class="flex flex-row justify-center">
                        <div class="flex w-3/4 text-sm items-center">
                            {{ $question->polling_question }}
                        </div>
                        <div class="flex w-12">
                            <input type="radio" name="answer[{{ $student->id }}][{{ $question->id }}]" value="yes"/>
                            <span>Yes</span>

                            <input type="radio" name="answer[{{ $student->id }}][{{ $question->id }}]" value="no"/>
                            <span>No</span>
                                
                        </div>
                    </div>
                @elseif($question->question_type == 'text')
                    <div class="flex flex-col justify-center items-center mt-3">
                        <div class="flex w-3/4">{{ $question->polling_question }}</div>
                        <div class="flex w-3/4">
                            <textarea cols='80' name="answer[{{ $student->id }}][{{ $question->id }}]" class="border-2 border-black shadow-sm block w-full h-24 mt-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                @endif

            @endforeach
            </div>

        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 mb-3 btn btn-primary">
                    Submit Polling
                </button>
            </div>
        </div>
{{--    </form>--}}

    {{ Form::close() }}
    </div>

@endsection
