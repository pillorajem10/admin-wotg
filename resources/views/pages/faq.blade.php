@extends('layouts.layout')

@section('title', 'FAQs')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css?v=2.1') }}">
@endsection

@section('content')
    <div class="container faq-cont">
        <h1 class="faq-title">FAQs for WOTG Digital Missionaries App</h1>

        <!-- General Questions Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">General Questions</h2>

            <div class="faq-item">
                <h3 class="faq-question">1. What is the purpose of this app?</h3>
                <p class="faq-answer">Ang app na ito ay ginawa upang matulungan ang missionaries na kumonekta sa seekers, ibahagi ang ebanghelyo, at gabayan sila papunta sa discipleship groups.</p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">2. How do I know which seeker is assigned to me?</h3>
                <p class="faq-answer">Makikita mo ang mga seekers na naka-assign sa iyo sa "Seekers" section ng app.</p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">3. What should I do if a seeker doesn’t respond to my messages?</h3>
                <p class="faq-answer">Magpakita ng pasensya at paggalang. Patuloy na ipanalangin ang seeker at magpadala ng follow-up messages pagkatapos ng ilang araw. Halimbawa:
                    <ul>
                        <li>“Hi [Name], gusto ko lang kumustahin ka. Sana okay ka at maayos ang lahat.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">4. What is the process for seeker’s discipleship?</h3>
                <p class="faq-answer">Sundin ang PLANT process:
                    <ul>
                        <li>P: Pray – Ipanalangin sila.</li>
                        <li>L: Love – Ipakita ang malasakit at pag-aaruga.</li>
                        <li>A: Announce – Ibahagi ang mensahe ng kaligtasan.</li>
                        <li>N: Nurture – Palaguin sila sa discipleship group.</li>
                        <li>T: Train – Turuan sila na maging disciple-maker.</li>
                    </ul>
                </p>
            </div>

        </section>

        <!-- Communication and Relationship Building Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">Communication and Relationship Building</h2>

            <div class="faq-item">
                <h3 class="faq-question">5. How do I start a conversation with a new seeker?</h3>
                <p class="faq-answer">Magsimula sa isang mainit at maayang pagbati. Halimbawa:
                    <ul>
                        <li>“Hi [Name], ako si [Your Name]. Excited akong makilala ka! Andito ako para magbigay ng encouragement sa journey mo.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">6. What if the seeker seems hesitant to open up?</h3>
                <p class="faq-answer">Igalang ang kanilang tempo. Mag-focus sa pagbuo ng tiwala sa pamamagitan ng pakikinig at pakikiramay. Halimbawa:
                    <ul>
                        <li>“Okay lang na hindi ka pa ready mag-share. Andito lang ako para makinig kung kailan mo gustong magkwento.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">7. How do I ask a seeker about their prayer needs?</h3>
                <p class="faq-answer">Magsimula sa isang simpleng tanong. Halimbawa:
                    <ul>
                        <li>“Mayroon ka bang gustong ipagdasal natin? Sabihin mo lang, ipapanalangin ko ito para sa iyo.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">8. What if the seeker asks a question I can’t answer?</h3>
                <p class="faq-answer">Maging tapat at sabihin: “Magandang tanong iyan! Hahanapin ko muna ang sagot at babalikan kita.” Gamitin ang app’s resource library o humingi ng tulong sa iyong leader.</p>
            </div>

        </section>

        <!-- Sharing the Gospel Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">Sharing the Gospel</h2>

            <div class="faq-item">
                <h3 class="faq-question">9. When is the right time to share the gospel?</h3>
                <p class="faq-answer">Maghintay ng senyales ng openness, tulad ng seeker na nagtatanong ng spiritual questions o nagpapakita ng interes na malaman ang higit pa tungkol sa Diyos. Ipanalangin ang guidance ng Holy Spirit.</p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">10. How do I share the gospel in a simple way?</h3>
                <p class="faq-answer">Gamitin ang structure na ito o kaya ay gamitin ang “Ang Daan Patungong Langit” sa Gospel Tract section:
                    <ul>
                        <li>God’s Love: “Mahal ka ng Diyos at may magandang plano Siya para sa buhay mo.”</li>
                        <li>Human Need: “Lahat tayo ay nagkulang at nangangailangan ng kapatawaran ng Diyos.”</li>
                        <li>Christ’s Sacrifice: “Namatay si Jesus para sa ating mga kasalanan at muling nabuhay para bigyan tayo ng buhay na walang hanggan.”</li>
                        <li>Our Response: “Kailangan nating tanggapin si Jesus bilang Tagapagligtas at sundin Siya.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">11. What if the seeker doesn’t understand the gospel?</h3>
                <p class="faq-answer">Magtanong ng clarifying questions para malaman ang kanilang mga duda. Ipaliwanag ito sa mas simpleng paraan gamit ang relatable na halimbawa.</p>
            </div>

        </section>

        <!-- Discipleship and Follow-up Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">Discipleship and Follow-up</h2>

            <div class="faq-item">
                <h3 class="faq-question">12. How do I invite a seeker to a discipleship group?</h3>
                <p class="faq-answer">Halimbawa:
                    <ul>
                        <li>“Gusto kitang anyayahan sa isang grupo kung saan maaari tayong mag-aral ng Salita ng Diyos at magtulungan sa ating spiritual journey. Open ka ba para dito?”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">13. What if the seeker declines to join a discipleship group?</h3>
                <p class="faq-answer">Igalang ang kanilang desisyon ngunit ipakita na bukas pa rin ang pinto para sa kanila. Halimbawa:
                    <ul>
                        <li>“Okay lang iyon! Andito pa rin ako para suportahan ka. Sabihin mo lang kung may gusto kang pag-usapan.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">14. How do I nurture a seeker in their faith journey?</h3>
                <p class="faq-answer">Hikayatin silang:
                    <ul>
                        <li>Magbasa ng Bible (magsimula sa recommended passages tulad ng Gospels).</li>
                        <li>Magdasal araw-araw.</li>
                        <li>Sumali sa isang discipleship group.</li>
                        <li>Dumalo sa online o local fellowship groups.</li>
                    </ul>
                </p>
            </div>

        </section>

        <!-- Technical Questions Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">Technical Questions</h2>

            <div class="faq-item">
                <h3 class="faq-question">15. What if I encounter a technical issue with the app?</h3>
                <p class="faq-answer">I-report ang problema sa “Help” o “Support” section ng app o mag-email sa [Support Email/Phone].</p>
            </div>

        </section>

        <!-- Special Scenarios Section -->
        <section class="faq-category">
            <h2 class="faq-category-title">Special Scenarios</h2>

            <div class="faq-item">
                <h3 class="faq-question">16. What if the seeker shares personal struggles like depression or family issues?</h3>
                <p class="faq-answer">Makinig ng may pakikiramay at magbigay ng encouragement. Halimbawa:
                    <ul>
                        <li>“Nakakalungkot na marinig ang pinagdadaanan mo. Ipagdarasal kita at sana maramdaman mo ang presensya ng Diyos. Nandito lang ako kung kailangan mo ng kausap.”</li>
                    </ul>
                </p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">17. How do I handle seekers who are of different faiths?</h3>
                <p class="faq-answer">Magpakita ng respeto at unawain ang kanilang pananampalataya. Mag-focus muna sa pagbuo ng relasyon bago ibahagi ang ebanghelyo.</p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">18. What if a seeker asks about controversial topics?</h3>
                <p class="faq-answer">Manatiling kalmado at tumugon ng may pagpapakumbaba gamit ang Biblical truths. Halimbawa:
                    <ul>
                        <li>“Magandang tanong iyan. Tingnan natin kung ano ang sinasabi ng Bible tungkol dito.”</li>
                    </ul>
                </p>
            </div>

        </section>

    </div>
@endsection
