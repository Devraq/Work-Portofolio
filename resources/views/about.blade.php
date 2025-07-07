@extends('layout')

@section('title', 'About Us')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="mb-4">About Us</h1>
            <p class="lead mb-4" style="color: var(--accent);">
                Welcome to our professional portfolio and news platform. We are passionate about delivering high-quality content, modern design, and a seamless user experience.
            </p>
            <hr class="my-4" style="border-top: 2px solid var(--highlight); width: 60px; margin: 2rem auto;">
            <div class="mb-4">
                <img src="/images/vnews.png" alt="Logo" style="max-width: 120px; margin-bottom: 1rem;">
            </div>
            <p style="color: var(--primary); font-size: 1.1rem;">
                <strong>Our Mission:</strong> To showcase our work, share insights, and keep you updated with the latest articles in a visually striking, professional environment.<br><br>
                <strong>What We Offer:</strong>
                <ul class="list-unstyled mt-3 mb-4" style="color: var(--primary);">
                    <li>• A curated portfolio of our best projects</li>
                    <li>• News and articles on design, development, and technology</li>
                    <li>• A modern, accessible, and responsive user interface</li>
                </ul>
                <strong>Contact:</strong> Reach out to us for collaborations, feedback, or just to say hello!
            </p>
        </div>
    </div>
</div>
@endsection
