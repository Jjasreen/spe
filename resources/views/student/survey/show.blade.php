@extends('surveylayout')

@section('content')


{{--    <form action="" class="space-y-8 divide-y divide-gray-200 mt-14">--}}
    {{ Form::open(['route' => ['submit_student_survey', $speStudent->uuid]]) }}
        <div class="space-y-2 mt-20">
            <div>
                <div>
                    <h2 class="font-bold text-center">
                        {{ $survey->survey_title }}
                    </h2>
                    <p class="mt-1 text-md text-left text-gray-500">
                        {!! $survey->survey_description !!}
                    </p>
                </div>
            </div>
            <br>

            <h2 class="font-bold text-left">Self Evaluation</h2>
            <br>
            <p class="mt-1 text-md text-gray-700 text-left">On the scale 1 - 5 above, rate your own contribution to the group on each of the criteria below:</p>
            <br>
            @foreach($survey->spe_survey_questions as $question)

                @if($question->question_type == 'scale')
                    <div class="flex flex-row justify-left">
                        <div class="flex w-3/4 text-sm items-left">
                            {{ $question->survey_question }}
                        </div>
                        <div class="flex w-13">
                            @for ($i=1; $i<=5; $i++)
                            <input type="radio" value="{{$i}}" class="mt-3 mb-3" name="answer[{{ $student->id }}][{{ $question->id }}]" min="1" max="5">
                            <span>{{$i}}</span>
                            @endfor
                           
                        </div>
                    </div>
                @elseif($question->question_type == 'text')
                    <div class="flex flex-col justify-left items-left mt-3">
                        <div class="flex w-3/4">{{ $question->survey_question }}</div>
                        <div class="flex w-3/4">
                            <textarea style="background-color:black; color:white !important;" class="form-control mt-3 mb-3" name="answer[{{ $student->id }}][{{ $question->id }}]" class="border-2 border-black shadow-sm block w-full h-24 mt-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                @endif

            @endforeach

          @foreach($teammates as $index => $individual)
                {{-- Peer-Assessment --}}
                <br>
                @once
                    <h2 class="font-bold text-left">Evaluation of The Other Group Members</h2>
                @endonce
                <br>
                <h4 class="font-bold text-left">Team Mate {{ $index+1 }}: {{ $individual->s_title.' '.$individual->s_givenname }} </h4>
                <br>
                <p class="mt-1 text-md text-gray-700 text-left">On the scale 1 - 5 above, rate your own contribution to the group on each of the criteria below:</p>
                <br>
                @foreach($survey->spe_survey_questions as $question)

                    @if($question->question_type == 'scale')
                        <div class="flex flex-row justify-left mt-3 mb-3">
                            <div class="flex w-4/4 text-sm items-left">
                                {{ $question->survey_question }}
                            </div>
                            <div class="flex w-12">
                                @for ($i=1; $i<=5; $i++)
                                <input type="radio" value="{{$i}}" class="mt-3 mb-3" name="answer[{{ $individual->id }}][{{ $question->id }}]" min="1" max="5">
                                <span>{{$i}}</span>
                                @endfor
                            </div>
                        </div>
                    @elseif($question->question_type == 'text')
                        <div class="flex flex-col justify-left items-left mt-3">
                            <div class="flex w-3/4">
                                {{ $question->survey_question }}
                            </div>
                            <div class="flex w-3/4 mt-3">
                                <textarea style="background-color:black; color: white !important" class="form-control" name="answer[{{ $individual->id }}][{{ $question->id }}]" class="border-2 border-black shadow-sm block w-full h-24 mt-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                    @endif

                @endforeach
            @endforeach

        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Survey
                </button>
            </div>
        </div>
{{--    </form>--}}

    {{ Form::close() }}

@endsection
