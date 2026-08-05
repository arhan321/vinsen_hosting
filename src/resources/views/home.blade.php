<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        name="description"
        content="Konsultasi farmasi, pembelian obat, dan informasi Apotek MD Farma Jakarta Utara."
    >
    <meta name="theme-color" content="#1238cc">

    <title>Apotek MD Farma | Konsultasi Farmasi</title>

    <link rel="icon" href="{{ asset('images/md-farma-logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/md-farma-logo-theme.css') }}">

    <style>
        :root {
            --home-blue: #1238cc;
            --home-blue-dark: #1735a6;
            --home-blue-deep: #172554;
            --home-blue-soft: #eef2ff;
            --home-ink: #202838;
            --home-muted: #687080;
            --home-border: #dde1e9;
            --home-surface: #ffffff;
            --home-canvas: #f6f7fb;
            --home-success: #12815f;
            --home-warning: #9b5514;
            --home-radius-sm: 12px;
            --home-radius-md: 18px;
            --home-radius-lg: 28px;
            --home-shadow-sm: 0 10px 28px rgba(31, 41, 55, .07);
            --home-shadow-lg: 0 24px 64px rgba(23, 37, 84, .14);
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 88px;
        }

        body {
            margin: 0;
            color: var(--home-ink);
            background: var(--home-canvas);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body,
        button,
        a { -webkit-tap-highlight-color: transparent; }

        img,
        svg { display: block; }

        a { color: inherit; }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid rgba(18, 56, 204, .34);
            outline-offset: 3px;
        }

        .home-container {
            width: min(1180px, calc(100% - 40px));
            margin-inline: auto;
        }

        .home-header {
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(221, 225, 233, .92);
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 5px 22px rgba(31, 41, 55, .045);
            backdrop-filter: blur(16px);
        }

        .home-nav {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .home-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--home-ink);
            text-decoration: none;
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -.025em;
        }

        .home-brand-logo {
            width: 50px;
            height: 50px;
            padding: 3px;
            flex: 0 0 auto;
            overflow: hidden;
            border: 1px solid var(--home-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(31, 41, 55, .09);
        }

        .home-brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }

        .home-nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .home-nav-links > a {
            color: #4b5563;
            text-decoration: none;
            font-size: 13px;
            font-weight: 780;
            transition: color .16s ease;
        }

        .home-nav-links > a:hover { color: var(--home-blue); }

        .home-btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 10px 17px;
            border: 1px solid transparent;
            border-radius: var(--home-radius-sm);
            font: inherit;
            font-size: 13px;
            font-weight: 850;
            line-height: 1.2;
            text-decoration: none;
            cursor: pointer;
            transition:
                transform .16s ease,
                border-color .16s ease,
                background .16s ease,
                box-shadow .16s ease,
                color .16s ease;
        }

        .home-btn:hover { transform: translateY(-1px); }

        .home-btn svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
        }

        .home-btn-primary {
            color: #fff !important;
            background: linear-gradient(135deg, var(--home-blue), #2a55df);
            box-shadow: 0 12px 28px rgba(18, 56, 204, .22);
        }

        .home-btn-primary:hover {
            background: linear-gradient(135deg, var(--home-blue-dark), var(--home-blue));
            box-shadow: 0 16px 32px rgba(18, 56, 204, .25);
        }

        .home-btn-secondary {
            border-color: var(--home-border);
            color: var(--home-ink) !important;
            background: #fff;
            box-shadow: none;
        }

        .home-btn-secondary:hover {
            border-color: rgba(18, 56, 204, .30);
            color: var(--home-blue) !important;
            background: #f8faff;
        }

        .home-nav-cta {
            min-height: 42px;
            padding-inline: 16px;
            color: #fff !important;
            border-radius: 11px;
            background: var(--home-blue);
            box-shadow: 0 9px 22px rgba(18, 56, 204, .19);
        }

        .home-hero {
            position: relative;
            overflow: hidden;
            padding: 76px 0 64px;
            background:
                radial-gradient(circle at 86% 13%, rgba(18, 56, 204, .13), transparent 28%),
                radial-gradient(circle at 8% 88%, rgba(83, 101, 141, .09), transparent 25%),
                linear-gradient(135deg, #fbfcff 0%, #eef2ff 100%);
        }

        .home-hero::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -210px;
            bottom: -250px;
            border: 70px solid rgba(18, 56, 204, .045);
            border-radius: 50%;
            pointer-events: none;
        }

        .home-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) minmax(360px, .92fr);
            align-items: center;
            gap: 72px;
        }

        .home-eyebrow {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 18px;
            padding: 7px 11px;
            border: 1px solid rgba(18, 56, 204, .13);
            border-radius: 999px;
            color: var(--home-blue-deep);
            background: rgba(255, 255, 255, .82);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .075em;
            text-transform: uppercase;
        }

        .home-eyebrow::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--home-blue);
            box-shadow: 0 0 0 4px rgba(18, 56, 204, .10);
        }

        .home-hero h1 {
            max-width: 720px;
            margin: 0;
            font-size: clamp(44px, 5.4vw, 68px);
            line-height: 1.02;
            letter-spacing: -.055em;
        }

        .home-hero h1 span { color: var(--home-blue); }

        .home-hero-lead {
            max-width: 650px;
            margin: 23px 0 29px;
            color: var(--home-muted);
            font-size: 17px;
            line-height: 1.72;
        }

        .home-hero-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 11px;
        }

        .home-trust {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 18px;
            margin-top: 27px;
            color: #566070;
            font-size: 12px;
            font-weight: 750;
        }

        .home-trust span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .home-trust i {
            width: 20px;
            height: 20px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: var(--home-blue);
            background: var(--home-blue-soft);
            font-style: normal;
            font-size: 11px;
            font-weight: 950;
        }

        .home-access-card {
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: var(--home-radius-lg);
            background: rgba(255, 255, 255, .90);
            box-shadow: var(--home-shadow-lg);
            backdrop-filter: blur(18px);
        }

        .home-access-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        .home-access-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .home-access-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border-radius: 15px;
            color: #fff;
            background: linear-gradient(145deg, var(--home-blue-deep), var(--home-blue));
            box-shadow: 0 10px 24px rgba(18, 56, 204, .19);
        }

        .home-access-icon svg {
            width: 23px;
            height: 23px;
            stroke: currentColor;
        }

        .home-access-title strong {
            display: block;
            margin-bottom: 4px;
            font-size: 16px;
        }

        .home-access-title small {
            color: var(--home-muted);
            font-size: 11px;
        }

        .home-open-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border: 1px solid rgba(18, 129, 95, .14);
            border-radius: 999px;
            color: var(--home-success);
            background: #edfbf6;
            font-size: 10px;
            font-weight: 900;
            white-space: nowrap;
        }

        .home-open-status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22a47d;
            box-shadow: 0 0 0 4px rgba(34, 164, 125, .10);
        }

        .home-open-status.closed {
            border-color: rgba(155, 85, 20, .14);
            color: var(--home-warning);
            background: #fff7ec;
        }

        .home-open-status.closed::before {
            background: #e88c30;
            box-shadow: 0 0 0 4px rgba(232, 140, 48, .10);
        }

        .home-access-list {
            display: grid;
            gap: 10px;
            margin-bottom: 19px;
        }

        .home-access-item {
            display: grid;
            grid-template-columns: 38px minmax(0, 1fr);
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e7eaf0;
            border-radius: 14px;
            background: #fafbfe;
        }

        .home-access-item > span {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            color: var(--home-blue);
            background: var(--home-blue-soft);
        }

        .home-access-item svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
        }

        .home-access-item strong {
            display: block;
            margin-bottom: 2px;
            font-size: 13px;
        }

        .home-access-item small {
            display: block;
            color: var(--home-muted);
            font-size: 10px;
            line-height: 1.45;
        }

        .home-access-card .home-btn { width: 100%; }

        .home-schedule-note {
            margin: 12px 0 0;
            color: var(--home-muted);
            font-size: 10px;
            line-height: 1.5;
            text-align: center;
        }

        .home-section { padding: 82px 0; }

        .home-section-soft { background: #fff; }

        .home-section-head {
            max-width: 720px;
            margin-bottom: 31px;
        }

        .home-kicker {
            display: block;
            margin-bottom: 10px;
            color: var(--home-blue);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .home-section-head h2 {
            margin: 0;
            font-size: clamp(30px, 4vw, 43px);
            line-height: 1.12;
            letter-spacing: -.04em;
        }

        .home-section-head p {
            max-width: 650px;
            margin: 13px 0 0;
            color: var(--home-muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .home-services {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .home-service-card {
            min-height: 255px;
            display: flex;
            flex-direction: column;
            padding: 23px;
            border: 1px solid var(--home-border);
            border-radius: var(--home-radius-md);
            background: #fff;
            box-shadow: var(--home-shadow-sm);
            transition:
                transform .16s ease,
                border-color .16s ease,
                box-shadow .16s ease;
        }

        .home-service-card:hover {
            transform: translateY(-3px);
            border-color: rgba(18, 56, 204, .22);
            box-shadow: 0 16px 38px rgba(31, 41, 55, .10);
        }

        .home-service-icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            margin-bottom: 19px;
            border-radius: 14px;
            color: var(--home-blue);
            background: var(--home-blue-soft);
        }

        .home-service-icon svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
        }

        .home-service-card h3 {
            margin: 0 0 9px;
            font-size: 18px;
            letter-spacing: -.025em;
        }

        .home-service-card p {
            margin: 0 0 22px;
            color: var(--home-muted);
            font-size: 13px;
            line-height: 1.65;
        }

        .home-text-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: auto;
            color: var(--home-blue);
            text-decoration: none;
            font-size: 12px;
            font-weight: 900;
        }

        .home-text-link::after {
            content: "→";
            transition: transform .16s ease;
        }

        .home-text-link:hover::after { transform: translateX(3px); }

        .home-visit-grid {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 18px;
        }

        .home-info-card {
            min-height: 280px;
            padding: 27px;
            border: 1px solid var(--home-border);
            border-radius: var(--home-radius-md);
            background: #fff;
            box-shadow: var(--home-shadow-sm);
        }

        .home-info-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 21px;
        }

        .home-info-head > span {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border-radius: 13px;
            color: var(--home-blue);
            background: var(--home-blue-soft);
        }

        .home-info-head svg {
            width: 21px;
            height: 21px;
            stroke: currentColor;
        }

        .home-info-head h3 {
            margin: 0 0 3px;
            font-size: 17px;
        }

        .home-info-head p {
            margin: 0;
            color: var(--home-muted);
            font-size: 11px;
        }

        .home-schedule {
            display: grid;
            gap: 10px;
        }

        .home-schedule-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 13px 0;
            border-bottom: 1px solid #eceff4;
            font-size: 12px;
        }

        .home-schedule-row:last-child { border-bottom: 0; }

        .home-schedule-row span { color: var(--home-muted); }

        .home-address {
            margin: 0 0 22px;
            color: var(--home-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .home-marketplaces {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
        }

        .home-marketplace-card {
            min-height: 145px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
            padding: 20px;
            border: 1px solid var(--home-border);
            border-radius: var(--home-radius-md);
            color: var(--home-ink);
            background: #fff;
            box-shadow: var(--home-shadow-sm);
            text-decoration: none;
            transition:
                transform .16s ease,
                border-color .16s ease,
                box-shadow .16s ease;
        }

        .home-marketplace-card:hover {
            transform: translateY(-3px);
            border-color: rgba(18, 56, 204, .23);
            box-shadow: 0 16px 38px rgba(31, 41, 55, .10);
        }

        .home-marketplace-logo {
            min-height: 48px;
            display: flex;
            align-items: center;
        }

        .home-marketplace-logo img {
            width: auto;
            max-width: 138px;
            max-height: 44px;
        }

        .home-marketplace-card strong {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .home-marketplace-card span {
            color: var(--home-blue);
            font-size: 11px;
            font-weight: 850;
        }

        .home-safety-note {
            display: flex;
            gap: 12px;
            margin-top: 22px;
            padding: 16px 18px;
            border: 1px solid #f0d9b7;
            border-radius: 14px;
            color: #6e4a21;
            background: #fff8ee;
        }

        .home-safety-note svg {
            width: 21px;
            height: 21px;
            flex: 0 0 auto;
            stroke: currentColor;
        }

        .home-safety-note strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .home-safety-note p {
            margin: 0;
            font-size: 11px;
            line-height: 1.55;
        }

        .home-partnership {
            padding: 0 0 82px;
            background: #fff;
        }

        .home-partnership-card {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(280px, .75fr);
            align-items: center;
            gap: 34px;
            padding: 40px;
            border-radius: var(--home-radius-lg);
            color: #fff;
            background: linear-gradient(135deg, #172554 0%, #1238cc 100%);
            box-shadow: 0 24px 58px rgba(23, 37, 84, .22);
        }

        .home-partnership-card::after {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            right: -165px;
            bottom: -210px;
            border: 55px solid rgba(255, 255, 255, .075);
            border-radius: 50%;
            pointer-events: none;
        }

        .home-partnership-copy,
        .home-partnership-steps {
            position: relative;
            z-index: 1;
        }

        .home-partnership-copy .home-kicker { color: #cbd7ff; }

        .home-partnership-copy h2 {
            max-width: 680px;
            margin: 0;
            font-size: clamp(28px, 4vw, 41px);
            line-height: 1.13;
            letter-spacing: -.04em;
        }

        .home-partnership-copy p {
            max-width: 680px;
            margin: 14px 0 23px;
            color: rgba(255, 255, 255, .78);
            font-size: 13px;
            line-height: 1.7;
        }

        .home-partnership-copy .home-btn {
            color: var(--home-blue-deep) !important;
            background: #fff;
            box-shadow: 0 12px 30px rgba(4, 12, 39, .20);
        }

        .home-partnership-steps {
            display: grid;
            gap: 10px;
            padding: 17px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 17px;
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(12px);
        }

        .home-partnership-steps strong {
            margin-bottom: 3px;
            font-size: 12px;
        }

        .home-step {
            display: grid;
            grid-template-columns: 27px minmax(0, 1fr);
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, .82);
            font-size: 11px;
        }

        .home-step b {
            width: 27px;
            height: 27px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            color: var(--home-blue-deep);
            background: #fff;
            font-size: 10px;
        }

        .home-final-cta {
            padding: 0 0 76px;
            background: #fff;
        }

        .home-final-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            padding: 30px 34px;
            border: 1px solid #d8e0fb;
            border-radius: 21px;
            background: #f2f5ff;
        }

        .home-final-card h2 {
            margin: 0 0 7px;
            font-size: 24px;
            letter-spacing: -.035em;
        }

        .home-final-card p {
            margin: 0;
            color: var(--home-muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .home-footer {
            border-top: 1px solid var(--home-border);
            background: #fff;
        }

        .home-footer-main {
            display: grid;
            grid-template-columns: 1.3fr .75fr 1fr;
            gap: 38px;
            padding: 42px 0 31px;
        }

        .home-footer-brand { margin-bottom: 14px; }

        .home-footer p,
        .home-footer span,
        .home-footer a {
            color: var(--home-muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .home-footer h3 {
            margin: 0 0 11px;
            font-size: 12px;
        }

        .home-footer-links {
            display: grid;
            gap: 7px;
        }

        .home-footer-links a {
            text-decoration: none;
        }

        .home-footer-links a:hover { color: var(--home-blue); }

        .home-footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 16px 0;
            border-top: 1px solid #eef0f4;
        }

        @media (max-width: 980px) {
            .home-hero-grid,
            .home-partnership-card {
                grid-template-columns: 1fr;
            }

            .home-hero-grid { gap: 42px; }

            .home-access-card { max-width: 690px; }

            .home-services { grid-template-columns: 1fr 1fr; }

            .home-service-card:last-child { grid-column: 1 / -1; }

            .home-marketplaces { grid-template-columns: repeat(2, minmax(0, 1fr)); }

            .home-footer-main { grid-template-columns: 1fr 1fr; }

            .home-footer-main > :first-child {
                grid-column: 1 / -1;
                max-width: 680px;
            }
        }

        @media (max-width: 760px) {
            .home-container { width: min(100% - 28px, 1180px); }

            .home-nav { min-height: 68px; }

            .home-brand-logo {
                width: 43px;
                height: 43px;
                border-radius: 12px;
            }

            .home-brand { font-size: 16px; }

            .home-nav-links > a:not(.home-nav-cta):not(.home-nav-profile) {
                display: none;
            }

            .home-nav-cta {
                min-height: 40px;
                padding-inline: 13px;
                font-size: 11px !important;
            }

            .home-hero { padding: 58px 0 54px; }

            .home-hero h1 { font-size: clamp(40px, 12.5vw, 57px); }

            .home-hero-lead { font-size: 15px; }

            .home-section { padding: 62px 0; }

            .home-services,
            .home-visit-grid,
            .home-footer-main {
                grid-template-columns: 1fr;
            }

            .home-service-card:last-child,
            .home-footer-main > :first-child { grid-column: auto; }

            .home-partnership { padding-bottom: 62px; }

            .home-partnership-card { padding: 29px 25px; }

            .home-final-cta { padding-bottom: 62px; }

            .home-final-card {
                align-items: flex-start;
                flex-direction: column;
                padding: 26px;
            }

            .home-footer-main { gap: 27px; }

            .home-footer-bottom {
                align-items: flex-start;
                flex-direction: column;
                gap: 6px;
            }
        }

        @media (max-width: 520px) {
            .home-container { width: min(100% - 22px, 1180px); }

            .home-nav-profile { display: none !important; }

            .home-nav-cta { display: inline-flex !important; }

            .home-hero-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .home-hero-actions .home-btn { width: 100%; }

            .home-access-card {
                padding: 18px;
                border-radius: 22px;
            }

            .home-access-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .home-open-status { white-space: normal; }

            .home-marketplaces { grid-template-columns: 1fr; }

            .home-schedule-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 4px;
            }

            .home-partnership-card { border-radius: 22px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }

            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>
</head>
<body>
    <header class="home-header">
        <nav class="home-nav home-container" aria-label="Navigasi utama">
            <a class="home-brand" href="{{ route('home') }}">
                <span class="home-brand-logo" aria-hidden="true">
                    <img
                        src="{{ asset('images/md-farma-logo.jpeg') }}"
                        alt=""
                        width="52"
                        height="52"
                    >
                </span>
                <span>MD Farma</span>
            </a>

            <div class="home-nav-links">
                <a class="home-nav-profile" href="{{ route('profile') }}">Profil</a>
                <a href="#layanan">Layanan</a>
                <a href="#operasional">Jam & Lokasi</a>
                <a href="#marketplace">Marketplace</a>
                <a href="{{ route('partnership') }}">Kerja Sama</a>
                <a class="home-nav-cta" href="{{ route('consultation.entry') }}">
                    Mulai Konsultasi
                </a>
            </div>
        </nav>
    </header>

    <main>
        <section class="home-hero">
            <div class="home-hero-grid home-container">
                <div>
                    <p class="home-eyebrow">Konsultasi farmasi digital</p>

                    <h1>
                        Konsultasi obat yang
                        <span>lebih mudah dan terarah.</span>
                    </h1>

                    <p class="home-hero-lead">
                        Tanyakan penggunaan obat, kirim gambar resep, atau
                        lanjutkan riwayat konsultasi melalui ruang chat privat
                        bersama Apotek MD Farma.
                    </p>

                    <div class="home-hero-actions">
                        <a
                            class="home-btn home-btn-primary"
                            href="{{ route('consultation.entry') }}"
                        >
                            Mulai Konsultasi
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </a>

                        <a class="home-btn home-btn-secondary" href="#marketplace">
                            Lihat Marketplace
                        </a>
                    </div>

                    <div class="home-trust" aria-label="Keunggulan layanan">
                        <span><i>✓</i>Chat privat</span>
                        <span><i>✓</i>Gambar & PDF</span>
                        <span><i>✓</i>Riwayat terlindungi</span>
                    </div>
                </div>

                <aside class="home-access-card" aria-label="Akses cepat konsultasi">
                    <div class="home-access-head">
                        <div class="home-access-title">
                            <span class="home-access-icon" aria-hidden="true">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                                    <path d="M14 7h4M16 5v4"/>
                                </svg>
                            </span>
                            <div>
                                <strong>Layanan konsultasi</strong>
                                <small>Apotek MD Farma</small>
                            </div>
                        </div>

                        <span class="home-open-status" data-open-status aria-live="polite">
                            Memeriksa jam layanan
                        </span>
                    </div>

                    <div class="home-access-list">
                        <div class="home-access-item">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 5h18v14H3z"/>
                                    <path d="m3 7 9 6 9-6"/>
                                </svg>
                            </span>
                            <div>
                                <strong>Konsultasi obat & resep</strong>
                                <small>Sampaikan pertanyaan atau unggah resep.</small>
                            </div>
                        </div>

                        <div class="home-access-item">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </span>
                            <div>
                                <strong>Akses riwayat aman</strong>
                                <small>Dilindungi Password Riwayat dan perangkat tepercaya.</small>
                            </div>
                        </div>

                        <div class="home-access-item">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </span>
                            <div>
                                <strong>Respons sesuai jam layanan</strong>
                                <small>Pesan tetap dapat dikirim di luar jam operasional.</small>
                            </div>
                        </div>
                    </div>

                    <a
                        class="home-btn home-btn-primary"
                        href="{{ route('consultation.entry') }}"
                    >
                        Buka Konsultasi
                    </a>

                    <p class="home-schedule-note">
                        Senin–Jumat 08.00–20.00 WIB · Sabtu–Minggu 08.00–21.00 WIB
                    </p>
                </aside>
            </div>
        </section>

        <section class="home-section home-section-soft" id="layanan">
            <div class="home-container">
                <div class="home-section-head">
                    <span class="home-kicker">Layanan MD Farma</span>
                    <h2>Pilih layanan sesuai kebutuhan Anda</h2>
                    <p>
                        Setiap pilihan memiliki tujuan yang berbeda sehingga
                        Anda dapat langsung menuju langkah yang dibutuhkan.
                    </p>
                </div>

                <div class="home-services">
                    <article class="home-service-card">
                        <span class="home-service-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                                <path d="M14 7h4M16 5v4"/>
                            </svg>
                        </span>
                        <h3>Konsultasi obat dan resep</h3>
                        <p>
                            Tanyakan aturan pakai, efek samping, interaksi,
                            atau kirim gambar resep melalui chat privat.
                        </p>
                        <a class="home-text-link" href="{{ route('consultation.entry') }}">
                            Mulai konsultasi
                        </a>
                    </article>

                    <article class="home-service-card">
                        <span class="home-service-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2h12l2 5H4z"/>
                                <path d="M4 7v13h16V7"/>
                                <path d="M9 11h6"/>
                            </svg>
                        </span>
                        <h3>Belanja produk resmi</h3>
                        <p>
                            Akses toko resmi MD Farma melalui marketplace
                            pilihan untuk melihat produk dan proses pembelian.
                        </p>
                        <a class="home-text-link" href="#marketplace">
                            Lihat marketplace
                        </a>
                    </article>

                    <article class="home-service-card">
                        <span class="home-service-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M19 8v6M16 11h6"/>
                            </svg>
                        </span>
                        <h3>Kerja sama bisnis</h3>
                        <p>
                            Ajukan kolaborasi pengadaan, distribusi, komunitas,
                            atau kebutuhan bisnis lainnya bersama MD Farma.
                        </p>
                        <a class="home-text-link" href="{{ route('partnership') }}">
                            Buka halaman kerja sama
                        </a>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-section" id="operasional">
            <div class="home-container">
                <div class="home-section-head">
                    <span class="home-kicker">Kunjungi apotek</span>
                    <h2>Jam operasional dan lokasi</h2>
                    <p>
                        Informasi operasional ini juga menjadi acuan waktu
                        respons konsultasi dari Apotek MD Farma.
                    </p>
                </div>

                <div class="home-visit-grid">
                    <article class="home-info-card">
                        <div class="home-info-head">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </span>
                            <div>
                                <h3>Jam operasional</h3>
                                <p>Zona waktu Indonesia Barat</p>
                            </div>
                        </div>

                        <div class="home-schedule">
                            <div class="home-schedule-row">
                                <span>Senin – Jumat</span>
                                <strong>08.00 – 20.00 WIB</strong>
                            </div>
                            <div class="home-schedule-row">
                                <span>Sabtu – Minggu</span>
                                <strong>08.00 – 21.00 WIB</strong>
                            </div>
                        </div>
                    </article>

                    <article class="home-info-card">
                        <div class="home-info-head">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>
                            </span>
                            <div>
                                <h3>Alamat Apotek MD Farma</h3>
                                <p>Warakas, Tanjung Priok, Jakarta Utara</p>
                            </div>
                        </div>

                        <p class="home-address">
                            Jl. Warakas V Gg. 7 No.125 12, RT.12/RW.9,
                            Warakas, Kec. Tj. Priok, Jakarta Utara 14370.
                        </p>

                        <a
                            class="home-btn home-btn-primary"
                            href="https://maps.app.goo.gl/82xaeQfUQYvyrork8"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Buka Google Maps
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M14 3h7v7M10 14 21 3"/>
                                <path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"/>
                            </svg>
                        </a>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-section home-section-soft" id="marketplace">
            <div class="home-container">
                <div class="home-section-head">
                    <span class="home-kicker">Toko online resmi</span>
                    <h2>Belanja melalui marketplace pilihan Anda</h2>
                    <p>
                        Tautan berikut membuka toko resmi Apotek MD Farma pada
                        tab baru.
                    </p>
                </div>

                <div class="home-marketplaces">
                    <a
                        class="home-marketplace-card"
                        href="https://www.tokopedia.com/apotek-md-farma-jakarta"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="home-marketplace-logo">
                            <img src="{{ asset('images/marketplaces/tokopedia.svg') }}" alt="Tokopedia">
                        </div>
                        <div>
                            <strong>Apotek MD Farma Jakarta</strong>
                            <span>Kunjungi Tokopedia →</span>
                        </div>
                    </a>

                    <a
                        class="home-marketplace-card"
                        href="https://shopee.co.id/apotekmdfarma"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="home-marketplace-logo">
                            <img src="{{ asset('images/marketplaces/shopee.svg') }}" alt="Shopee">
                        </div>
                        <div>
                            <strong>Apotek MD Farma</strong>
                            <span>Kunjungi Shopee →</span>
                        </div>
                    </a>

                    <a
                        class="home-marketplace-card"
                        href="https://store.goapotik.com/penjual/Apotek-MD-Farma"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="home-marketplace-logo">
                            <img src="{{ asset('images/marketplaces/goapotik.svg') }}" alt="GoApotik">
                        </div>
                        <div>
                            <strong>Apotek MD Farma</strong>
                            <span>Kunjungi GoApotik →</span>
                        </div>
                    </a>

                    <a
                        class="home-marketplace-card"
                        href="https://blibli.onelink.me/GNtk/aahkq31g"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="home-marketplace-logo">
                            <img src="{{ asset('images/marketplaces/blibli.svg') }}" alt="Blibli">
                        </div>
                        <div>
                            <strong>Apotek MD Farma</strong>
                            <span>Kunjungi Blibli →</span>
                        </div>
                    </a>
                </div>

                <aside class="home-safety-note">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                        <path d="M12 9v4M12 17h.01"/>
                    </svg>
                    <div>
                        <strong>Bukan layanan kegawatdaruratan</strong>
                        <p>
                            Untuk kondisi darurat atau gejala berat, segera
                            hubungi fasilitas kesehatan atau layanan darurat terdekat.
                        </p>
                    </div>
                </aside>
            </div>
        </section>

        <section class="home-partnership" id="kerja-sama">
            <div class="home-container">
                <div class="home-partnership-card">
                    <div class="home-partnership-copy">
                        <span class="home-kicker">Kolaborasi dengan MD Farma</span>
                        <h2>Punya kebutuhan atau peluang kerja sama?</h2>
                        <p>
                            Gunakan halaman khusus kerja sama untuk membuka
                            WhatsApp resmi, memindai QR, atau menyalin tautan
                            kontak MD Farma.
                        </p>
                        <a class="home-btn" href="{{ route('partnership') }}">
                            Buka Halaman Kerja Sama
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </a>
                    </div>

                    <aside class="home-partnership-steps" aria-label="Langkah kerja sama">
                        <strong>Tiga langkah sederhana</strong>
                        <div class="home-step"><b>1</b><span>Buka halaman kerja sama.</span></div>
                        <div class="home-step"><b>2</b><span>Pilih QR, WhatsApp, atau salin tautan.</span></div>
                        <div class="home-step"><b>3</b><span>Sampaikan kebutuhan dan kontak Anda.</span></div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="home-final-cta">
            <div class="home-container">
                <div class="home-final-card">
                    <div>
                        <h2>Masih ragu sebelum membeli obat?</h2>
                        <p>
                            Mulai konsultasi dan sampaikan pertanyaan Anda
                            kepada Apotek MD Farma.
                        </p>
                    </div>
                    <a
                        class="home-btn home-btn-primary"
                        href="{{ route('consultation.entry') }}"
                    >
                        Mulai Konsultasi
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="home-footer">
        <div class="home-footer-main home-container">
            <div>
                <a class="home-brand home-footer-brand" href="{{ route('home') }}">
                    <span class="home-brand-logo" aria-hidden="true">
                        <img src="{{ asset('images/md-farma-logo.jpeg') }}" alt="" width="52" height="52">
                    </span>
                    <span>MD Farma</span>
                </a>
                <p>
                    Layanan konsultasi farmasi digital dan akses pembelian
                    melalui marketplace resmi Apotek MD Farma.
                </p>
            </div>

            <div>
                <h3>Jam operasional</h3>
                <div class="home-footer-links">
                    <span>Senin–Jumat<br>08.00–20.00 WIB</span>
                    <span>Sabtu–Minggu<br>08.00–21.00 WIB</span>
                </div>
            </div>

            <div>
                <h3>Informasi</h3>
                <div class="home-footer-links">
                    <a href="{{ route('profile') }}">Profil MD Farma</a>
                    <a href="{{ route('partnership') }}">Kerja Sama</a>
                    <a href="{{ route('privacy') }}">Kebijakan Privasi</a>
                    <a href="https://maps.app.goo.gl/82xaeQfUQYvyrork8" target="_blank" rel="noopener noreferrer">Google Maps</a>
                    <a href="{{ route('admin.login') }}">Login Admin</a>
                </div>
            </div>
        </div>

        <div class="home-footer-bottom home-container">
            <span>© {{ date('Y') }} Apotek MD Farma.</span>
            <span>Informasi pada chat tidak menggantikan pemeriksaan dokter.</span>
        </div>
    </footer>

    <script>
        (() => {
            const statusElements = document.querySelectorAll('[data-open-status]');

            if (!statusElements.length) {
                return;
            }

            const getJakartaTime = () => {
                const formatter = new Intl.DateTimeFormat('en-US', {
                    timeZone: 'Asia/Jakarta',
                    weekday: 'short',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                    hourCycle: 'h23',
                });

                const parts = formatter.formatToParts(new Date());
                const values = Object.fromEntries(
                    parts.map((part) => [part.type, part.value])
                );

                return {
                    weekday: values.weekday,
                    hour: Number(values.hour),
                    minute: Number(values.minute),
                };
            };

            const updateStatus = () => {
                const now = getJakartaTime();
                const weekend = ['Sat', 'Sun'].includes(now.weekday);
                const closeHour = weekend ? 21 : 20;
                const totalMinutes = (now.hour * 60) + now.minute;
                const isOpen = totalMinutes >= (8 * 60)
                    && totalMinutes < (closeHour * 60);

                const text = isOpen
                    ? `Buka sampai ${String(closeHour).padStart(2, '0')}.00 WIB`
                    : 'Tutup, buka pukul 08.00 WIB';

                statusElements.forEach((element) => {
                    element.textContent = text;
                    element.classList.toggle('closed', !isOpen);
                });
            };

            updateStatus();
            window.setInterval(updateStatus, 60000);
        })();
    </script>
</body>
</html>
