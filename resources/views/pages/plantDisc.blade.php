@extends('layouts.layout')

@section('title', 'PLANT Discipleship Guide')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/plantDisc.css?v=2.3') }}">
@endsection

@section('content')
    <div class="container plantDisc-cont">
        <h1 class="plantDisc-title">PLANT Discipleship Guide</h1>
        <p class="intro-text">
            The PLANT discipleship process helps missionaries initiate and nurture meaningful relationships with seekers, 
            leading them toward spiritual growth and equipping them to become disciple-makers.
        </p>

        <!-- PLANT Discipleship Steps -->
        <section class="plant-disc-steps">
            <div class="step">
                <h2 class="step-title">P: Pray – Commit Them to God in Prayer</h2>
                <p class="step-description">
                    <strong>Pray for Seekers Intentionally:</strong>
                    <ul>
                        <li>Before engaging with a seeker, spend time praying for their spiritual journey, openness, and understanding.</li>
                        <li>Pray for wisdom and guidance on how to approach and minister to them.</li>
                    </ul>
                    <strong>Pray During Conversations:</strong>
                    <ul>
                        <li>Silently lift up prayers during conversations, asking God to guide your words and soften their hearts.</li>
                        <li>Example: “Lord, help me to listen well and share Your love clearly.”</li>
                    </ul>
                    <strong>Involve the Seeker in Prayer:</strong>
                    <ul>
                        <li>Encourage them to share prayer requests. Use these as opportunities to build trust and show care.</li>
                        <li>Example: “May gusto ka bang ipagdasal natin ngayon? I’m here to pray with you.”</li>
                    </ul>
                </p>
            </div>

            <div class="step">
                <h2 class="step-title">L: Love – Show Care and Compassion</h2>
                <p class="step-description">
                    <strong>Build Genuine Relationships:</strong>
                    <ul>
                        <li>Start by getting to know the seeker personally. Learn about their background, interests, and challenges.</li>
                        <li>Use conversation starters like: “Kamusta ang araw mo?” or “May mga bagay ka bang pinag-iisipan o gustong maipagdasal?”</li>
                    </ul>
                    <strong>Listen Actively:</strong>
                    <ul>
                        <li>Pay attention to their responses. Validate their feelings and show empathy.</li>
                        <li>Example: “Mukhang mahirap ang pinagdadaanan mo. Salamat sa pagbabahagi mo sa akin.”</li>
                    </ul>
                    <strong>Be Consistent in Care:</strong>
                    <ul>
                        <li>Follow up regularly to show that you genuinely care.</li>
                        <li>Example: “Naalala kita ngayong araw at ipinanalangin kita. Kamusta ka na?”</li>
                    </ul>
                </p>
            </div>

            <div class="step">
                <h2 class="step-title">A: Announce – Share the Message of Salvation</h2>
                <p class="step-description">
                    <strong>Prepare to Share the Gospel:</strong>
                    <ul>
                        <li>Familiarize yourself with a simple way to present the gospel:
                            <ul>
                                <li>God’s Love: “Mahal tayo ng Diyos at may plano Siya para sa atin.”</li>
                                <li>Our Problem: “Lahat tayo ay nagkulang at nangangailangan ng kapatawaran.”</li>
                                <li>Christ’s Solution: “Namatay si Jesus para sa ating mga kasalanan at muling nabuhay para bigyan tayo ng bagong buhay.”</li>
                                <li>Our Response: “Kailangan natin tanggapin si Jesus bilang ating Tagapagligtas at sundin Siya.”</li>
                            </ul>
                        </li>
                    </ul>
                    <strong>Look for the Right Moment:</strong>
                    <ul>
                        <li>Share the gospel when the seeker shows interest or asks questions about faith. Pray for discernment.</li>
                    </ul>
                    <strong>Keep the Message Simple:</strong>
                    <ul>
                        <li>Avoid overcomplicating the message. Focus on God’s love and grace.</li>
                    </ul>
                    <strong>Answer Questions Humbly:</strong>
                    <ul>
                        <li>If they have doubts, listen and respond with humility.</li>
                        <li>Example: “Magandang tanong iyan. Tingnan natin kung ano ang sinasabi ng Salita ng Diyos.”</li>
                    </ul>
                </p>
            </div>

            <div class="step">
                <h2 class="step-title">N: Nurture – Disciple Them in a Group Setting</h2>
                <p class="step-description">
                    <strong>Invite Them to a Discipleship Group:</strong>
                    <ul>
                        <li>Explain the purpose of the group as a safe space to learn and grow together.</li>
                        <li>Example: “Ang grupo namin ay nag-aaral ng Salita ng Diyos at nagtutulungan sa ating pananampalataya. Sana makasama ka.”</li>
                    </ul>
                    <strong>Provide Spiritual Guidance:</strong>
                    <ul>
                        <li>Help them build spiritual habits:
                            <ul>
                                <li>Daily Bible reading (suggest passages like John or Psalms).</li>
                                <li>Regular prayer time.</li>
                                <li>Attending fellowship or worship services.</li>
                            </ul>
                        </li>
                    </ul>
                    <strong>Foster Accountability:</strong>
                    <ul>
                        <li>Encourage sharing of spiritual goals and regularly check on their progress.</li>
                        <li>Example: “Kamusta ang pagbabasa mo ng Bible? May mga tanong ka bang lumitaw?”</li>
                    </ul>
                    <strong>Encourage Openness:</strong>
                    <ul>
                        <li>Create an environment where they feel safe to ask questions or share struggles.</li>
                        <li>Example: “Ano ang mga natutunan mo ngayong linggo sa iyong quiet time?”</li>
                    </ul>
                </p>
            </div>

            <div class="step">
                <h2 class="step-title">T: Train – Empower Them to Make Disciples</h2>
                <p class="step-description">
                    <strong>Share the Vision of Disciple-Making:</strong>
                    <ul>
                        <li>Help them understand that discipleship includes helping others grow in faith.</li>
                        <li>Example: “Ang plano ng Diyos ay gamitin tayo para magdala ng iba sa Kanya.”</li>
                    </ul>
                    <strong>Teach Practical Steps:</strong>
                    <ul>
                        <li>Equip them with tools and confidence to share their faith.</li>
                        <li>Role-play gospel-sharing scenarios.</li>
                        <li>Example: “Pwede nating simulang ibahagi ang kwento ni Jesus sa mga kaibigan o pamilya mo.”</li>
                    </ul>
                    <strong>Assign Small Responsibilities:</strong>
                    <ul>
                        <li>Encourage them to start leading in small ways, like facilitating discussions or sharing a devotional.</li>
                        <li>Example: “Pwede ka bang mag-share ng maikling reflection sa ating next meeting?”</li>
                    </ul>
                    <strong>Celebrate Milestones:</strong>
                    <ul>
                        <li>Acknowledge their growth and encourage them to continue the disciple-making cycle.</li>
                        <li>Example: “Napakaganda ng ginagawa mo. Mas marami pa ang malalapit kay Jesus sa pamamagitan mo.”</li>
                    </ul>
                </p>
            </div>
        </section>

        <!-- Be Spirit-Led Section -->
        <section class="spirit-led">
            <h2 class="spirit-led-title">Be Spirit-Led</h2>
            <p class="spirit-led-text">
                Sa bawat hakbang, hayaan ang Holy Spirit na gumabay. Trust in God’s timing and His work in their lives.
            </p>
        </section>

    </div>
@endsection
