<!-- CAll To Action Start -->
<section class="call__to__action">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta__box__wrapper text-center">
                    <h2 class="cta__title">Sign up for new inventions </h2>
                    <p class="cta__content">Stay updated with what is new in health and lifestyle management</p>
                    <form action="{{url('contactus')}}" method="post" class="cta__form">
                        @csrf
                        <input type="email" name="email" class="form-control" maxlength="50" placeholder="Enter your email" required="required"/>
                        <button type="submit" class="btn btn-primary">Notify me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CAll To Action End -->