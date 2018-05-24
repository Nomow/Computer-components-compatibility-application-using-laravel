<!doctype html>
<html lang="en">

@include('includes.head')

<body>

    @include('includes.navigation')
    <div class="full-page-wrapper">

        <div style="background: url('img/{{$bgImg}}.jpg') 50% 50% no-repeat;  background-size: cover;" class="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="twelve columns">
                        <h5>{{$headTitle}}</h5>
                        <p>{{$headParagraph}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="parts-wrapper">
            <div class="container">

                <div class="row">
                    <div class="twelve columns">


                        {!! Form::open(['method'=>'GET','url'=>$url,'role'=>'search']) !!}

                        <div class="search">
                            <span class="float-right">
                                <button class="search-btn" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                <span class="input-right">
                                    <input type="text" class="searchTerm" name="search" placeholder="Meklēt detaļu...">
                                </span>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <div class="resp">

                            <table>
                                <thead>

                                    @foreach ($headerval as $part=>$value)


                                    <th>
                                        <a class="table-sort" href="{{$url}}&sort={{$part}}&order={{$value}}">{{trans('specifications.' .$part)}} @if($value == 'asc')
                                            <i class="fa fa-sort-asc"
                                                aria-hidden="true"></i>@else
                                            <i class="fa fa-sort-desc" aria-hidden="true"></i>@endif</a>
                                    </th>
                                    @endforeach

                                </thead>
                                <tbody>

                                    @foreach ($parts as $part => $value)
                                    <tr>
                                        @foreach ($value as $desc => $val) @if($val == reset($value))
                                        <td class="part-link">
                                            <a href="{{$slug}}{{$value->slug}}">{{$val}} </a>
                                        </td>
                                        @elseif ($val == end($value))



                                        <td class="part-link-btns">
                                            <a class="button button-primary save-session" data-url="{{ route('session.store', ['name' => $session_name, 'value' => $value->slug]) }}">Pievienot</a>

                                            <a class="button button-hollow view-btn" href="{{$slug}}{{$value->slug}}">Apskatīt</a>
                                        </td>
                                        @else

                                        <td data-title="{{trans('specifications.' .$desc)}}:">{{$val}}</td>
                                        @endif @endforeach
                                    </tr>

                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- end of div row -->
                @include('pagination.default', ['paginator' =>$parts])
            </div>
            <!-- end of container  -->
        </div>
        <!-- end of partzs wrapper -->


        @include('includes.footer')
    </div>
    <!-- end of full-page-warpper-->
</body>

</html>
