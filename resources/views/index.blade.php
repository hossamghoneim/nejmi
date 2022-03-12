@extends('layouts.app')
@section('content')

    <!-- Content start -->
{{--    <div class="container">--}}

{{--        <!-- Hero start -->--}}
{{--        <div class="hero">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <img src="assets/images/hero.jpg" alt="Hero">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Hero end -->--}}

{{--        <!-- People Section -->--}}
{{--        <section class="section">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <h3>أحدث المشاهير</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="people">--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/php9WIE0B-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/phplJ8Xze-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/phpxelJtz-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/qU2bsyIYD6Pv2YAJbopO7yoUYMIPAlYzQ1ztLZrH-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/seJnySkD0ibIWWoTknISMOmQsKuc40hIvkRyaQrF-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <!-- People Section -->--}}
{{--        <section class="section">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <h3>عروض مميزة</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="people">--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/php9WIE0B-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/phplJ8Xze-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/phpxelJtz-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/qU2bsyIYD6Pv2YAJbopO7yoUYMIPAlYzQ1ztLZrH-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/seJnySkD0ibIWWoTknISMOmQsKuc40hIvkRyaQrF-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--                <div class="single">--}}
{{--                    <img src="assets/images/people/Y3ajqmPLO7GOB8pXaggBsoITUCgvV0uwsLcdh1dG-thumbnail.png">--}}
{{--                    <h5>اسم الشخص</h5>--}}
{{--                    <h6>100$</h6>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--    </div>--}}
    <!-- Content end -->

    <div id="app">
        <App />
    </div>
    <!-- Footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="footer-menu">
                        <li>
                            <a href="">اتصل بنا</a>
                        </li>
                        <li>
                            <a href="">من نحن</a>
                        </li>
                        <li>
                            <a href="">الشروط والأحكام</a>
                        </li>
                        <li>
                            <a href="">سياسة الخصوصية</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

@endsection
{{--<script>--}}
{{--    import Home from "../js/components/Home";--}}
{{--    export default {--}}
{{--        components: {Home}--}}
{{--    }--}}
{{--</script>--}}
