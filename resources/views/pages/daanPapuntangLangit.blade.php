@extends('layouts.layout')

@section('title', 'Daan Papuntang Langit')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/daanPapuntangLangit.css?v=2.3') }}">
@endsection

@section('content')
    <div class="container daan-cont">
        <h1 class="text-center heading-title">Ang Daan Papuntang Langit</h1>
        <p class="intro-text">May apat na katotohanan na dapat nating malaman upang makapunta tayo sa langit.</p>

        <ol class="truth-list">
            <li class="truth-item">
                <strong class="truth-heading">Mahal ka ng Diyos at nais Niya na magkaroon ka ng buhay na walang hanggan.</strong>
                <p class="truth-verse">"Sapagkat gayon na lamang ang pag-ibig ng Diyos sa sangkatauhan, kaya't ibinigay niya ang kanyang kaisa-isang Anak, upang ang sinumang sumampalataya sa kanya ay hindi mapahamak, kundi magkaroon ng buhay na walang hanggan." - <em>John 3:16</em></p>
                <p>
                    <h3>
                        Nais din Niyang magkaron ka ng buhay na makabuluhan.
                    </h3>
                </p>
                <p class="truth-verse">"Dumarating ang magnanakaw para lamang magnakaw, pumatay, at manira. Naparito ako upang ang mga tupa ay magkaroon ng buhay, buhay na masaganang lubos." - <em>John 10:10</em></p>
                <p>
                    <h3>
                        Kaya lang maraming tao ang hindi 
                        nakakaranas ng buhay na walang hanggan 
                        at buhay na makabuluhan sapagkat...
                    </h3>
                </p>
            </li>

            <li class="truth-item">
                <strong class="truth-heading">Likas na makasalanan ang tao kaya napahiwalay siya sa Diyos.</strong>
                <img src="{{ asset('images/gospel_tract1.jpg') }}" alt="Image description" class="truth-image">
                <p class="truth-verse">"Sapagkat ang lahat ay nagkasala, at walang sinumang nakaabot sa kaluwalhatian ng Diyos." - <em>Romans 3:23</em></p>
                <p>
                    <h3>
                        Hindi lang sa nagkasala ang lahat ng tao 
                        kundi may bayad ang kasalanan at ang 
                        bayad ay kamatayan.                        
                    </h3>
                </p>
                <p class="truth-verse">"Sapagkat kamatayan ang kabayaran ng kasalanan..." - <em>Romans 6:23</em></p>
                <p>
                    <h3>
                        May dalawang klase ng kamatayan ang 
                        nasa Biblia ang una ay pisikal at ang 
                        pangalawa ay espiritwal.                                            
                    </h3>
                </p>
                <p class="truth-verse">"Subalit para naman sa mga duwag, mga taksil, ... at sa lahat ng mga sinungaling—ang magiging bahagi nila'y sa lawa ng nagliliyab na apoy at asupre. Ito ang pangalawang kamatayan." - <em>Revelation 21:8</em></p>
                <img src="{{ asset('images/gospel_tract2.jpg') }}" alt="Image description" class="truth-image">
                <p>
                    <h3>
                        ..inisip ng tao na ang kanyang pagkahiwalay 
                        sa Diyos ay masosolusyunan ng...             
                    </h3>
                </p>
                <img src="{{ asset('images/gospel_tract3.jpg') }}" alt="Image description" class="truth-image">
                <p>
                    <h3>
                        Subalit ang lahat ng ito ay kapos at hindi 
                        aabot sa kaluwalhatian ng Diyos dahil ang 
                        lahat ay nagkasala.
                    </h3>
                </p>
            </li>
            

            <li class="truth-item">
                <strong class="truth-heading">Ang Panginoong Hesus ang tanging daan patungong langit.</strong>
                <p class="truth-verse">"Sumagot si Jesus, “Ako ang daan, ang katotohanan, at ang buhay. Walang makakapunta sa Ama kundi sa pamamagitan ko.” - <em>John 14:6</em></p>
                <p>
                    <h3>
                        Bakit ang Panginoong Hesus lang ang daan? 
                        Dahil. Siya lang nagbayad ng lahat ng iyung 
                        kasalanan sa krus.                        
                    </h3>
                </p>
                <p class="truth-verse">"Sapagkat si Cristo na walang kasalanan ay namatay nang minsan para sa inyo na mga makasalanan, upang iharap kayo sa Diyos. Siya'y pinatay sa laman, at muling binuhay sa espiritu." - <em>1 Peter 3:18</em></p>
                <img src="{{ asset('images/gospel_tract4.jpg') }}" alt="Image description" class="truth-image">
                <p>
                    <h3>
                        “Subalit ang malaman lang na namatay ang 
                        Panginoong Hesus para sa iyung kasalanan 
                        ay hindi sapat…”                        
                    </h3>
                </p>
            </li>

            <li class="truth-item">
                <strong class="truth-heading">Kailangan nating manampalataya sa Panginoong Hesus upang tayo'y maligtas.</strong>
                <p class="truth-verse">"Sapagkat dahil sa kagandahang-loob ng Diyos kayo ay naligtas sa pamamagitan ng pananampalataya; at ito'y kaloob ng Diyos at hindi mula sa inyong sarili; hindi ito bunga ng inyong mga gawa kaya't walang maipagmamalaki ang sinuman." - <em>Ephesians 2:8-9</em></p>
                <p>
                    <h3>
                        Base sa Ephesians 2:8-9, kung ilalagay 
                        sa formula ang kaligtasan, alin sa mga 
                        sumusunod ang sa tingin mo ay tama?                                               
                    </h3>
                </p>
                <p>
                    <h3>
                        ...ang mabuting gawa ay hindi basehan 
                        ng kaligtasan kundi ito ay by-product o 
                        magiging bunga sa buhay ng taong 
                        totoong nanampalataya sa 
                        Panginoong Hesus.                                                                 
                    </h3>
                </p>
            </li>
        </ol>

        <p class="faith-statement">Ipahayag mo ang iyong pananampalataya sa Panginoong Hesus sa pamamagitan ng panalangin...</p>
        <blockquote class="prayer-text">
            <p>
                Panginoong Hesus, Inaamin ko po na ako ay makasalanan. Patawarin mo po ako. Nananampalataya po ako na ikaw ang tanging daan patungo sa langit dahil ikaw ang nagbayad ng aking kasalanan. Ngayon nga ay binubuksan ko na ang aking puso. Pumasok ka at manahan sa akin. Tinatanggap kita bilang aking Panginoon at Tagapagligtas. Simula ngayon ay tatalikdan ko na ang aking kasalanan. Salamat at isang araw ay makakasama kita sa langit. Amen.
            </p>
        </blockquote>

        <p class="salvation-result">Kung nanampalataya ka sa Panginoong Hesus bilang iyong Panginoon at Tagapagligtas:</p>
        <ul class="salvation-points">
            <li class="salvation-point">
                Ikaw ay naging anak na ng Diyos. 
                <p class="truth-verse">
                    "Subalit ang lahat ng tumanggap at 
                    sumampalataya sa kanya ay binigyan 
                    niya ng karapatang maging mga 
                    anak ng Diyos.
                    " - 
                    <em>John 1:12</em>
                </p>
            </li>
            <li class="salvation-point">
                May buhay na walang hanggan.
                <p class="truth-verse">
                    “12 Kung ang Anak ng Diyos ay nasa 
                    isang tao, mayroon siyang buhay na 
                    walang hanggan; ngunit kung wala sa 
                    kanya ang Anak ng Diyos ay wala 
                    siyang buhay na walang hanggan.
                    13 Isinusulat ko ito sa inyo upang 
                    malaman ninyo na kayong 
                    sumasampalataya sa Anak ng Diyos ay 
                    may buhay na walang hanggan.” 
                     - 
                    <em>1 John 5:12-13</em>
                </p>
            </li>
            <li class="salvation-point">
                Ikaw ay isa nang bagong nilalang.
                <p class="truth-verse">
                    “Kaya't kung nakipag-isa na kay Cristo 
                    ang isang tao, isa na siyang bagong 
                    nilalang. Wala na ang dati niyang 
                    pagkatao, sa halip, ito'y napalitan 
                    na ng bago.” -                    
                    <em>2 Corinthians 5:17</em>
                </p>
            </li>
            <li class="salvation-point">
                Ang lahat ng kasalanan mo ay bayad na.
                <p class="truth-verse">
                    “Iniligtas niya tayo sa kapangyarihan 
                    ng kadiliman at inilipat tayo sa kaharian 
                    ng kanyang minamahal na Anak, na sa 
                    kanya ay mayroon tayong katubusan, na 
                    siyang kapatawaran ng mga kasalanan.”                    
                     - 
                    <em>Colosas 1:13-14</em>
                </p>
            </li>
        </ul>

        <p class="growth-guide">Upang lumago sa relasyon mo sa Kanya:</p>
        <ul class="growth-points">
            <li class="growth-point"><strong>Makipag-usap sa Diyos araw-araw:</strong> Manalangin ka at makinig sa sasabihin Niya sa iyo sa pamamagitan ng pagbabasa ng Biblia.</li>
            <li class="growth-point"><strong>Maging bahagi ng isang discipleship group:</strong> Dito mo makakasama ang mga kapatiran na makakatulong sa iyong paglago.</li>
            <li class="growth-point"><strong>Dumalo sa isang Christian church na naniniwala sa Biblia:</strong> Upang makapagpuri at magpasalamat sa Diyos.</li>
        </ul>
    </div>
@endsection
