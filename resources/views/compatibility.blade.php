<!doctype html>
<html lang="en">
@include('includes.head')

<body>
    @include('includes.navigation')
    <div class="full-page-wrapper">
        <div class="comp-wrapper">
            <div class="container">
                <div class="row">

                    <?php if (Session::has('cpu') ||
    Session::has('cpu_cooler') ||
    Session::has('motherboard') ||
    Session::has('memory') ||
    Session::has('storage') ||
    Session::has('case') ||
    Session::has('gpu') ||
    Session::has('optical_drive') ||
    Session::has('psu') ||
    Session::has('sound_card') ||
    Session::has('wireless_card') ||
    Session::has('wired_card') ||
    Session::has('case_fan')) {
    ?>
                    <div id="compatibility-check">
                        @if($error == false)
                        <span id='true'>
                            <i class="fa fa-check" aria-hidden="true"></i>Visas detaļas ir saderīgas</span>
                        @else
                        <?php $error_count = count($error_desc)?>
                        <span id='false'>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            @if ($error_count == 1) {{$error_count}} potenciāla nesaderība (Skatīt) @else {{$error_count}} potenciālas nesaderības (Skatīt)
                            @endif
                        </span>

                        @endif
                    </div>
                    <?php }?>
                    <table>
                        <thead>
                            <th>Detala</th>
                            <th>Nosaukums</th>
                            <th>Piegade</th>
                            <th>Cena</th>
                            <th>Tirgotajs</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>

                            <!-- cpu -->

                            @if (Session::has('cpu'))
                            <?php $count = 0;?>
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="procesori">Procesori</a>@endif</td>

                                <td>
                                    <a href="procesors-{{$cpu->slug}}">{{$cpu->processor}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($cpu->delivery))
                                    <a href="{{$cpu->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($cpu->price))
                                    <a href="{{$cpu->url}}">&euro;{{$cpu->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($cpu->retailer))
                                    <a href="{{$cpu->url}}">{{$cpu->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'cpu', 'value' => $count]) }}"> Dzēst detaļu</a>
                                    @if(!empty($cpu->url))
                                    <a class="button button-primary buy-btn" href="{{$cpu->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'cpu', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="procesori">Procesori</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="procesori">Izvēlies procesoru</a>
                                </td>
                            </tr>
                            @endif


                            <!-- cpu_cooler 1-->


                            @if (Session::has('cpu_cooler'))
                            <?php $count = 0;?>
                            <tr class="odd">

                                <td class="part">@if($count == 0)
                                    <a href="procesora-dzesetaji">Procesora dzesētāji</a>@endif</td>

                                <td>
                                    <a href="procesora-dzesetajs-{{$cpu_cooler->slug}}">{{$cpu_cooler->cpu_cooler}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($cpu_cooler->delivery))
                                    <a href="{{$cpu_cooler->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($cpu_cooler->price))
                                    <a href="{{$cpu_cooler->url}}">&euro;{{$cpu_cooler->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($cpu_cooler->retailer))
                                    <a href="{{$cpu_cooler->url}}">{{$cpu_cooler->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'cpu_cooler', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($cpu_cooler->url))
                                    <a class="button button-primary buy-btn" href="{{$cpu_cooler->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'cpu_cooler', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="procesora-dzesetaji">Procesoru dzesētāji</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="procesora-dzesetaji">Izvēlies procesora dzesētāju</a>
                                </td>
                            </tr>
                            @endif

                            <!-- motherboard 1-->

                            @if (Session::has('motherboard'))
                            <?php $count = 0;?>
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="matesplates">Mātesplates</a>@endif</td>

                                <td>
                                    <a href="matesplate-{{$motherboard->slug}}">{{$motherboard->motherboard}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($motherboard->delivery))
                                    <a href="{{$motherboard->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($motherboard->price))
                                    <a href="{{$motherboard->url}}">&euro;{{$motherboard->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($motherboard->retailer))
                                    <a href="{{$motherboard->url}}">{{$motherboard->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'motherboard', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($motherboard->url))
                                    <a class="button button-primary buy-btn" href="{{$motherboard->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'motherboard', 'value' => $count]) }}">&#215;</a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="matesplates">Mātesplates</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="matesplates">Izvēlies mātesplati</a>
                                </td>
                            </tr>
                            @endif


                            <!-- Memory -->
                            @if (Session::has('memory'))
                            <?php $count = 0;?> @foreach ($memory as $mem)
                            <tr class="odd">

                                <td class="part">@if($count == 0)
                                    <a href="operativa-atmina">Operatīvā atmiņa</a>@endif</td>

                                <td>
                                    <a href="operativa-atmina-{{$mem->slug}}">{{$mem->memory}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'memory', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'memory', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr class="odd">
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="operativa-atmina">Pievienot operativo atminu</a</td>
                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="operativa-atmina">Operatīvā atmiņa</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="operativa-atmina">Izvēlies operatīvo atmiņu</a>
                                </td>
                            </tr>
                            @endif

                            <!-- storage -->
                            @if (Session::has('storage'))
                            <?php $count = 0;?> @foreach ($storage as $mem)
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="atminas">Cietie diski</a>@endif</td>

                                <td>
                                    <a href="atmina-{{$mem->slug}}">{{$mem->storage}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'storage', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'storage', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr>
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="atminas">Pievienot cieto disku</a</td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="atminas">Cietie diski</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="atminas">Izvēlies cieto disku</a>
                                </td>
                            </tr>
                            @endif

                            <!-- case 1-->

                            @if (Session::has('case'))
                            <?php $count = 0;?>
                            <tr class="odd">

                                <td class="part">@if($count == 0)
                                    <a href="korpusi">Korpusi</a>@endif</td>

                                <td>
                                    <a href="korpuss-{{$case->slug}}">{{$case->case}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($case->delivery))
                                    <a href="{{$case->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($case->price))
                                    <a href="{{$case->url}}">&euro;{{$case->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($case->retailer))
                                    <a href="{{$case->url}}">{{$case->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'case', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($case->url))
                                    <a class="button button-primary buy-btn" href="{{$case->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'case', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="korpusi">Korpusi</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="korpusi">Izvēlies Korpusu</a>
                                </td>
                            </tr>
                            @endif

                            <!-- gpu -->

                            @if (Session::has('gpu'))
                            <?php $count = 0;?>
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="video-kartes">Video kartes</a>@endif</td>

                                <td>
                                    <a href="video-karte-{{$gpu->slug}}">{{$gpu->gpu}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($gpu->delivery))
                                    <a href="{{$gpu->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($gpu->price))
                                    <a href="{{$gpu->url}}">&euro;{{$gpu->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($gpu->retailer))
                                    <a href="{{$gpu->url}}">{{$gpu->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'gpu', 'value' => $count]) }}"> Dzēst detaļu</a>
                                    @if(!empty($gpu->url))
                                    <a class="button button-primary buy-btn" href="{{$gpu->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'gpu', 'value' => $count]) }}">&#215;</a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="video-kartes">Video kartes</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="video-kartes">Izvēlies Video karti</a>
                                </td>
                            </tr>
                            @endif

                            <!-- power supply 1-->

                            @if (Session::has('psu'))
                            <?php $count = 0;?>
                            <tr class="odd">
                                <td class="part">@if($count == 0)
                                    <a href="barosanas-bloki">Barošanas bloki</a>@endif</td>

                                <td>
                                    <a href="barosanas-bloks-{{$psu->slug}}">{{$psu->psu}}</a>
                                </td>
                                <td data-title="Piegāde">@if(!empty($psu->delivery))
                                    <a href="{{$psu->delivery}}">Skatīt</a>@endif</td>
                                <td data-title="Cena">@if(!empty($psu->price))
                                    <a href="{{$psu->url}}">&euro;{{$psu->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($psu->retailer))
                                    <a href="{{$psu->url}}">{{$psu->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'psu', 'value' => $count]) }}"> Dzēst detaļu</a>
                                    @if(!empty($psu->url))
                                    <a class="button button-primary buy-btn" href="{{$psu->url}}">Pirkt</a>@endif
                                </td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'psu', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="barosanas-bloki">Barošanas bloki</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="barosanas-bloki">Izvēlies barošanas bloku</a>
                                </td>
                            </tr>
                            @endif

                            <!-- optical_drive -->
                            @if (Session::has('optical_drive'))
                            <?php $count = 0;?> @foreach ($optical_drive as $mem)
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="diskdzini">Diskdziņi</a>@endif</td>

                                <td>
                                    <a href="diskdzinis-{{$mem->slug}}">{{$mem->optical_drive}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'optical_drive', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'optical_drive', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr>
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="diskdzini">Pievienot diskdzini</a</td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="atminas">Diskdziņi</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="diskdzini">Izvēlies diskdzini</a>
                                </td>
                            </tr>
                            @endif

                            <!-- sound card -->
                            @if (Session::has('sound_card'))
                            <?php $count = 0;?> @foreach ($sound_card as $mem)
                            <tr class="odd">

                                <td class="part">@if($count == 0)
                                    <a href="skanas-kartes">Skaņas kartes</a>@endif</td>

                                <td>
                                    <a href="skanas-karte-{{$mem->slug}}">{{$mem->sound_card}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'sound_card', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'sound_card', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr class="odd">
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="skanas-kartes">Pievienot skaņas karti</a</td>
                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="skanas-kartes">Skaņas kartes</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="skanas-kartes">Izvēlies skaņas karti</a>
                                </td>
                            </tr>
                            @endif


                            <!-- wireless card -->


                            @if (Session::has('wireless_card'))
                            <?php $count = 0;?> @foreach ($wireless_card as $mem)
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="bezvadu-tikla-kartes">Bezvadu tīkla kartes</a>@endif</td>

                                <td>
                                    <a href="bezvadu-tikla-karte-{{$mem->slug}}">{{$mem->wireless_card}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'wireless_card', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'wireless_card', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr>
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="bezvadu-tikla-kartes">Pievienot bezvadu tīkla karti</a</td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="bezvadu-tikla-kartes">Bezvadu tīkla kartes</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="bezvadu-tikla-kartes">Izvēlies bezvadu tīkla karti</a>
                                </td>
                            </tr>
                            @endif

                            <!-- wired card -->


                            @if (Session::has('wired_card'))
                            <?php $count = 0;?> @foreach ($wired_card as $mem)
                            <tr class="odd">

                                <td class="part">@if($count == 0)
                                    <a href="tikla-kartes">Tīkla kartes</a>@endif</td>

                                <td>
                                    <a href="tikla-karte-{{$mem->slug}}">{{$mem->wired_card}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'wired_card', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'wired_card', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr class="odd">
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="tikla-kartes">Pievienot tīkla karti</a</td>
                            </tr>
                            @else
                            <tr class="odd">
                                <td class="part">
                                    <a href="tikla-kartes">Tīkla kartes</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="tikla-kartes">Izvēlies tīkla karti</a>
                                </td>
                            </tr>
                            @endif

                            <!-- case fan -->

                            @if (Session::has('case_fan'))
                            <?php $count = 0;?> @foreach ($case_fan as $mem)
                            <tr>

                                <td class="part">@if($count == 0)
                                    <a href="korpusa-ventilatori">Korpusa dzesētāji</a>@endif</td>

                                <td>
                                    <a href="korpusa-ventilators-{{$mem->slug}}">{{$mem->case_fan}}</a>
                                </td>

                                <td data-title="Piegāde">@if(!empty($mem->delivery))
                                    <a href="{{$mem->delivery}}">Skatit</a>@endif</td>
                                <td data-title="Cena">@if(!empty($mem->price))
                                    <a href="{{$mem->url}}">&euro;{{$mem->price}}</a>@endif</td>
                                <td data-title="Tirgotājs">@if(!empty($mem->retailer))
                                    <a href="{{$mem->url}}">{{$mem->retailer}}</a>@endif</td>
                                <td class="part-link">
                                    <a class="button button-primary delete-btn" href="{{ route('session.delete', ['name' => 'case_fan', 'value' => $count]) }}">
                                    Dzēst detaļu</a>
                                    @if(!empty($mem->url))
                                    <a class="button button-primary buy-btn" href="{{$mem->url}}">Pirkt</a>@endif</td>
                                <td class="del">
                                    <a class="delete-session" href="{{ route('session.delete', ['name' => 'case_fan', 'value' => $count]) }}">&#215;</a>
                                </td>

                            </tr>
                            <?php $count++;?> @endforeach
                            <tr>
                                <td class="filler">&nbsp;</td>
                                <td class="add-another">
                                    <a class="button button-primary add-btn" href="korpusa-ventilatori">Pievienot korpusa dzesētāju</a</td>
                            </tr>
                            @else
                            <tr>
                                <td class="part">
                                    <a href="korpusa-ventilatori">Korpusa dzesētāji</a>
                                </td>
                                <td class="add-another" colspan="4">
                                    <a class="button button-primary add-btn" href="korpusa-ventilatori">Izvēlies korpusa dzesētāju</a>
                                </td>
                            </tr>
                            @endif
                            </tr>
                        </tbody>
                    </table>

                    @if($error == true)
                    <div id="errordescription">
                        <h5 class="desctitle">Potenciālās nesaderības: </h5>
                        <ol>
                            @foreach($error_desc as $val)
                            <li>{{$val}} </li>
                            @endforeach
                    </div>
                    <!-- end of error desc-->
                    @endif
                    </ol>
                </div>
                <!-- end of div class row -->
            </div>
            <!-- end of div container-->
        </div>
        <!-- end of div compatibility wrapper -->
        @include('includes.footer')
    </div>
    <!-- end of full page wrapper-->
</body>

</html>