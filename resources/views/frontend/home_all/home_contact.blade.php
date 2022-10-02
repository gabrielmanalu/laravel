@php
     $footerpage = App\Models\Footer::find(1);
@endphp

<section class="homeContact homeContact__style__two">
    <div class="container">
        <div class="homeContact__wrap">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section__title">
                        <span class="sub-title">Say hello</span>
                        <h2 class="title">Any questions? Feel free <br> to contact</h2>
                    </div>
                    <div class="homeContact__content">
                        <h2 class="mail"><a href="mailto:{{ $footerpage->email }}">{{ $footerpage->email }}</a></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="homeContact__form">
                        <form method="POST" action="{{ route('store.message') }}" class="contact__form">
                            @csrf
                            <input name="name" type="text" placeholder="Enter name*">
                            <input name="email" type="email" placeholder="Enter mail*">
                            <input name="phone" type="number" placeholder="Enter number*">
                            <input name="subject" type="hidden" value="Home-Contact">
                            <textarea name="message" name="message" placeholder="Enter Massage*"></textarea>
                            <button type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
