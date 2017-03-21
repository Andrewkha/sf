<?php

/**
 * @var \yii\web\View
 * @var yii\mail\BaseMessage $content
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php $this->head() ?>
</head>
<body bgcolor="#f6f6f6" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin: 0; padding: 0;">
<style type="text/css">

    /*! normalize.css v3.0.3 | MIT License | github.com/necolas/normalize.css */
    html {
        font-family: sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    body {
        margin: 0;
    }
    footer,
    header,
    hgroup,
    main,
    menu,
    section,
    summary {
        display: block;
    }

    [hidden],
    template {
        display: none;
    }
    a {
        background-color: transparent;
    }
    a:active,
    a:hover {
        outline: 0;
    }
    b,
    strong {
        font-weight: bold;
    }
    h1 {
        margin: .67em 0;
        font-size: 2em;
    }

    small {
        font-size: 80%;
    }
    img {
        border: 0;
    }
    svg:not(:root) {
        overflow: hidden;
    }

    hr {
        height: 0;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
        margin: 0;
        font: inherit;
        color: inherit;
    }
    button {
        overflow: visible;
    }
    button,
    select {
        text-transform: none;
    }
    button,
    html input[type="button"],
    input[type="reset"],
    input[type="submit"] {
        -webkit-appearance: button;
        cursor: pointer;
    }
    button[disabled],
    html input[disabled] {
        cursor: default;
    }
    button::-moz-focus-inner,

    table {
        border-spacing: 0;
        border-collapse: collapse;
    }
    td,
    th {
        padding: 0;
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    html {
        font-size: 10px;

        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
    }
    input,
    button,
    select,
    textarea {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }
    a {
        color: #337ab7;
        text-decoration: none;
    }
    a:hover,
    a:focus {
        color: #23527c;
        text-decoration: underline;
    }
    a:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }
    figure {
        margin: 0;
    }
    img {
        vertical-align: middle;
    }
    .img-responsive,
    .thumbnail > img,
    .thumbnail a > img,

    .img-rounded {
        border-radius: 6px;
    }
    .img-thumbnail {
        display: inline-block;
        max-width: 100%;
        height: auto;
        padding: 4px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }
    .img-circle {
        border-radius: 50%;
    }
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee;
    }
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
    .sr-only-focusable:active,
    .sr-only-focusable:focus {
        position: static;
        width: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        clip: auto;
    }
    [role="button"] {
        cursor: pointer;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6 {
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
    }
    h1 small,
    h2 small,
    h3 small,
    h4 small,
    h5 small,
    h6 small,
    .h1 small,
    .h2 small,
    .h3 small,
    .h4 small,
    .h5 small,
    .h6 small,
    h1 .small,
    h2 .small,
    h3 .small,
    h4 .small,
    h5 .small,
    h6 .small,
    .h1 .small,
    .h2 .small,
    .h3 .small,
    .h4 .small,
    .h5 .small,
    .h6 .small {
        font-weight: normal;
        line-height: 1;
        color: #777;
    }
    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3 {
        margin-top: 20px;
        margin-bottom: 10px;
    }
    h1 small,
    .h1 small,
    h2 small,
    .h2 small,
    h3 small,
    .h3 small,
    h1 .small,
    .h1 .small,
    h2 .small,
    .h2 .small,
    h3 .small,
    .h3 .small {
        font-size: 65%;
    }
    h4,
    .h4,
    h5,
    .h5,
    h6,
    .h6 {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    h4 small,
    .h4 small,
    h5 small,
    .h5 small,
    h6 small,
    .h6 small,
    h4 .small,
    .h4 .small,
    h5 .small,
    .h5 .small,
    h6 .small,
    .h6 .small {
        font-size: 75%;
    }
    h1,
    .h1 {
        font-size: 36px;
    }
    h2,
    .h2 {
        font-size: 30px;
    }
    h3,
    .h3 {
        font-size: 24px;
    }
    h4,
    .h4 {
        font-size: 18px;
    }
    h5,
    .h5 {
        font-size: 14px;
    }
    h6,
    .h6 {
        font-size: 12px;
    }
    p {
        margin: 0 0 10px;
    }
    .lead {
        margin-bottom: 20px;
        font-size: 16px;
        font-weight: 300;
        line-height: 1.4;
    }
    @media (min-width: 768px) {
        .lead {
            font-size: 21px;
        }
    }
    small,
    .small {
        font-size: 85%;
    }
    mark,
    .mark {
        padding: .2em;
        background-color: #fcf8e3;
    }
    .text-left {
        text-align: left;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .text-justify {
        text-align: justify;
    }
    .text-nowrap {
        white-space: nowrap;
    }
    .text-lowercase {
        text-transform: lowercase;
    }
    .text-uppercase {
        text-transform: uppercase;
    }
    .text-capitalize {
        text-transform: capitalize;
    }
    .text-muted {
        color: #777;
    }
    .text-primary {
        color: #337ab7;
    }
    a.text-primary:hover,
    a.text-primary:focus {
        color: #286090;
    }
    .text-success {
        color: #3c763d;
    }
    a.text-success:hover,
    a.text-success:focus {
        color: #2b542c;
    }
    .text-info {
        color: #31708f;
    }
    a.text-info:hover,
    a.text-info:focus {
        color: #245269;
    }
    .text-warning {
        color: #8a6d3b;
    }
    a.text-warning:hover,
    a.text-warning:focus {
        color: #66512c;
    }
    .text-danger {
        color: #a94442;
    }
    a.text-danger:hover,
    a.text-danger:focus {
        color: #843534;
    }
    .bg-primary {
        color: #fff;
        background-color: #337ab7;
    }
    a.bg-primary:hover,
    a.bg-primary:focus {
        background-color: #286090;
    }
    .bg-success {
        background-color: #dff0d8;
    }
    a.bg-success:hover,
    a.bg-success:focus {
        background-color: #c1e2b3;
    }
    .bg-info {
        background-color: #d9edf7;
    }
    a.bg-info:hover,
    a.bg-info:focus {
        background-color: #afd9ee;
    }
    .bg-warning {
        background-color: #fcf8e3;
    }
    a.bg-warning:hover,
    a.bg-warning:focus {
        background-color: #f7ecb5;
    }
    .bg-danger {
        background-color: #f2dede;
    }
    a.bg-danger:hover,
    a.bg-danger:focus {
        background-color: #e4b9b9;
    }
    .page-header {
        padding-bottom: 9px;
        margin: 40px 0 20px;
        border-bottom: 1px solid #eee;
    }
    ul,
    ol {
        margin-top: 0;
        margin-bottom: 10px;
    }
    ul ul,
    ol ul,
    ul ol,
    ol ol {
        margin-bottom: 0;
    }
    .list-unstyled {
        padding-left: 0;
        list-style: none;
    }
    .list-inline {
        padding-left: 0;
        margin-left: -5px;
        list-style: none;
    }
    .list-inline > li {
        display: inline-block;
        padding-right: 5px;
        padding-left: 5px;
    }
    dl {
        margin-top: 0;
        margin-bottom: 20px;
    }
    dt,
    dd {
        line-height: 1.42857143;
    }
    dt {
        font-weight: bold;
    }
    dd {
        margin-left: 0;
    }
    @media (min-width: 768px) {
        .dl-horizontal dt {
            float: left;
            width: 160px;
            overflow: hidden;
            clear: left;
            text-align: right;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .dl-horizontal dd {
            margin-left: 180px;
        }
    }
    .initialism {
        font-size: 90%;
        text-transform: uppercase;
    }

    .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }
    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }
    @media (min-width: 1200px) {
        .container {
            width: 1170px;
        }
    }
    .container-fluid {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .row {
        margin-right: -15px;
        margin-left: -15px;
    }
    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }
    .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
        float: left;
    }
    .col-xs-12 {
        width: 100%;
    }
    .col-xs-11 {
        width: 91.66666667%;
    }
    .col-xs-10 {
        width: 83.33333333%;
    }
    .col-xs-9 {
        width: 75%;
    }
    .col-xs-8 {
        width: 66.66666667%;
    }
    .col-xs-7 {
        width: 58.33333333%;
    }
    .col-xs-6 {
        width: 50%;
    }
    .col-xs-5 {
        width: 41.66666667%;
    }
    .col-xs-4 {
        width: 33.33333333%;
    }
    .col-xs-3 {
        width: 25%;
    }
    .col-xs-2 {
        width: 16.66666667%;
    }
    .col-xs-1 {
        width: 8.33333333%;
    }
    .col-xs-pull-12 {
        right: 100%;
    }
    .col-xs-pull-11 {
        right: 91.66666667%;
    }
    .col-xs-pull-10 {
        right: 83.33333333%;
    }
    .col-xs-pull-9 {
        right: 75%;
    }
    .col-xs-pull-8 {
        right: 66.66666667%;
    }
    .col-xs-pull-7 {
        right: 58.33333333%;
    }
    .col-xs-pull-6 {
        right: 50%;
    }
    .col-xs-pull-5 {
        right: 41.66666667%;
    }
    .col-xs-pull-4 {
        right: 33.33333333%;
    }
    .col-xs-pull-3 {
        right: 25%;
    }
    .col-xs-pull-2 {
        right: 16.66666667%;
    }
    .col-xs-pull-1 {
        right: 8.33333333%;
    }
    .col-xs-pull-0 {
        right: auto;
    }
    .col-xs-push-12 {
        left: 100%;
    }
    .col-xs-push-11 {
        left: 91.66666667%;
    }
    .col-xs-push-10 {
        left: 83.33333333%;
    }
    .col-xs-push-9 {
        left: 75%;
    }
    .col-xs-push-8 {
        left: 66.66666667%;
    }
    .col-xs-push-7 {
        left: 58.33333333%;
    }
    .col-xs-push-6 {
        left: 50%;
    }
    .col-xs-push-5 {
        left: 41.66666667%;
    }
    .col-xs-push-4 {
        left: 33.33333333%;
    }
    .col-xs-push-3 {
        left: 25%;
    }
    .col-xs-push-2 {
        left: 16.66666667%;
    }
    .col-xs-push-1 {
        left: 8.33333333%;
    }
    .col-xs-push-0 {
        left: auto;
    }
    .col-xs-offset-12 {
        margin-left: 100%;
    }
    .col-xs-offset-11 {
        margin-left: 91.66666667%;
    }
    .col-xs-offset-10 {
        margin-left: 83.33333333%;
    }
    .col-xs-offset-9 {
        margin-left: 75%;
    }
    .col-xs-offset-8 {
        margin-left: 66.66666667%;
    }
    .col-xs-offset-7 {
        margin-left: 58.33333333%;
    }
    .col-xs-offset-6 {
        margin-left: 50%;
    }
    .col-xs-offset-5 {
        margin-left: 41.66666667%;
    }
    .col-xs-offset-4 {
        margin-left: 33.33333333%;
    }
    .col-xs-offset-3 {
        margin-left: 25%;
    }
    .col-xs-offset-2 {
        margin-left: 16.66666667%;
    }
    .col-xs-offset-1 {
        margin-left: 8.33333333%;
    }
    .col-xs-offset-0 {
        margin-left: 0;
    }
    @media (min-width: 768px) {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0;
        }
    }
    @media (min-width: 992px) {
        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
            float: left;
        }
        .col-md-12 {
            width: 100%;
        }
        .col-md-11 {
            width: 91.66666667%;
        }
        .col-md-10 {
            width: 83.33333333%;
        }
        .col-md-9 {
            width: 75%;
        }
        .col-md-8 {
            width: 66.66666667%;
        }
        .col-md-7 {
            width: 58.33333333%;
        }
        .col-md-6 {
            width: 50%;
        }
        .col-md-5 {
            width: 41.66666667%;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .col-md-3 {
            width: 25%;
        }
        .col-md-2 {
            width: 16.66666667%;
        }
        .col-md-1 {
            width: 8.33333333%;
        }
        .col-md-pull-12 {
            right: 100%;
        }
        .col-md-pull-11 {
            right: 91.66666667%;
        }
        .col-md-pull-10 {
            right: 83.33333333%;
        }
        .col-md-pull-9 {
            right: 75%;
        }
        .col-md-pull-8 {
            right: 66.66666667%;
        }
        .col-md-pull-7 {
            right: 58.33333333%;
        }
        .col-md-pull-6 {
            right: 50%;
        }
        .col-md-pull-5 {
            right: 41.66666667%;
        }
        .col-md-pull-4 {
            right: 33.33333333%;
        }
        .col-md-pull-3 {
            right: 25%;
        }
        .col-md-pull-2 {
            right: 16.66666667%;
        }
        .col-md-pull-1 {
            right: 8.33333333%;
        }
        .col-md-pull-0 {
            right: auto;
        }
        .col-md-push-12 {
            left: 100%;
        }
        .col-md-push-11 {
            left: 91.66666667%;
        }
        .col-md-push-10 {
            left: 83.33333333%;
        }
        .col-md-push-9 {
            left: 75%;
        }
        .col-md-push-8 {
            left: 66.66666667%;
        }
        .col-md-push-7 {
            left: 58.33333333%;
        }
        .col-md-push-6 {
            left: 50%;
        }
        .col-md-push-5 {
            left: 41.66666667%;
        }
        .col-md-push-4 {
            left: 33.33333333%;
        }
        .col-md-push-3 {
            left: 25%;
        }
        .col-md-push-2 {
            left: 16.66666667%;
        }
        .col-md-push-1 {
            left: 8.33333333%;
        }
        .col-md-push-0 {
            left: auto;
        }
        .col-md-offset-12 {
            margin-left: 100%;
        }
        .col-md-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-md-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-md-offset-9 {
            margin-left: 75%;
        }
        .col-md-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-md-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-md-offset-6 {
            margin-left: 50%;
        }
        .col-md-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-md-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-md-offset-3 {
            margin-left: 25%;
        }
        .col-md-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-md-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-md-offset-0 {
            margin-left: 0;
        }
    }
    @media (min-width: 1200px) {
        .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
            float: left;
        }
        .col-lg-12 {
            width: 100%;
        }
        .col-lg-11 {
            width: 91.66666667%;
        }
        .col-lg-10 {
            width: 83.33333333%;
        }
        .col-lg-9 {
            width: 75%;
        }
        .col-lg-8 {
            width: 66.66666667%;
        }
        .col-lg-7 {
            width: 58.33333333%;
        }
        .col-lg-6 {
            width: 50%;
        }
        .col-lg-5 {
            width: 41.66666667%;
        }
        .col-lg-4 {
            width: 33.33333333%;
        }
        .col-lg-3 {
            width: 25%;
        }
        .col-lg-2 {
            width: 16.66666667%;
        }
        .col-lg-1 {
            width: 8.33333333%;
        }
        .col-lg-pull-12 {
            right: 100%;
        }
        .col-lg-pull-11 {
            right: 91.66666667%;
        }
        .col-lg-pull-10 {
            right: 83.33333333%;
        }
        .col-lg-pull-9 {
            right: 75%;
        }
        .col-lg-pull-8 {
            right: 66.66666667%;
        }
        .col-lg-pull-7 {
            right: 58.33333333%;
        }
        .col-lg-pull-6 {
            right: 50%;
        }
        .col-lg-pull-5 {
            right: 41.66666667%;
        }
        .col-lg-pull-4 {
            right: 33.33333333%;
        }
        .col-lg-pull-3 {
            right: 25%;
        }
        .col-lg-pull-2 {
            right: 16.66666667%;
        }
        .col-lg-pull-1 {
            right: 8.33333333%;
        }
        .col-lg-pull-0 {
            right: auto;
        }
        .col-lg-push-12 {
            left: 100%;
        }
        .col-lg-push-11 {
            left: 91.66666667%;
        }
        .col-lg-push-10 {
            left: 83.33333333%;
        }
        .col-lg-push-9 {
            left: 75%;
        }
        .col-lg-push-8 {
            left: 66.66666667%;
        }
        .col-lg-push-7 {
            left: 58.33333333%;
        }
        .col-lg-push-6 {
            left: 50%;
        }
        .col-lg-push-5 {
            left: 41.66666667%;
        }
        .col-lg-push-4 {
            left: 33.33333333%;
        }
        .col-lg-push-3 {
            left: 25%;
        }
        .col-lg-push-2 {
            left: 16.66666667%;
        }
        .col-lg-push-1 {
            left: 8.33333333%;
        }
        .col-lg-push-0 {
            left: auto;
        }
        .col-lg-offset-12 {
            margin-left: 100%;
        }
        .col-lg-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-lg-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-lg-offset-9 {
            margin-left: 75%;
        }
        .col-lg-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-lg-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-lg-offset-6 {
            margin-left: 50%;
        }
        .col-lg-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-lg-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-lg-offset-3 {
            margin-left: 25%;
        }
        .col-lg-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-lg-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-lg-offset-0 {
            margin-left: 0;
        }
    }
    table {
        background-color: transparent;
    }
    caption {
        padding-top: 8px;
        padding-bottom: 8px;
        color: #777;
        text-align: left;
    }
    th {
        text-align: left;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .table > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .table .table {
        background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
        padding: 5px;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table-hover > tbody > tr:hover {
        background-color: #f5f5f5;
    }
    table col[class*="col-"] {
        position: static;
        display: table-column;
        float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
        position: static;
        display: table-cell;
        float: none;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
        background-color: #f5f5f5;
    }
    .table-hover > tbody > tr > td.active:hover,
    .table-hover > tbody > tr > th.active:hover,
    .table-hover > tbody > tr.active:hover > td,
    .table-hover > tbody > tr:hover > .active,
    .table-hover > tbody > tr.active:hover > th {
        background-color: #e8e8e8;
    }
    .table > thead > tr > td.success,
    .table > tbody > tr > td.success,
    .table > tfoot > tr > td.success,
    .table > thead > tr > th.success,
    .table > tbody > tr > th.success,
    .table > tfoot > tr > th.success,
    .table > thead > tr.success > td,
    .table > tbody > tr.success > td,
    .table > tfoot > tr.success > td,
    .table > thead > tr.success > th,
    .table > tbody > tr.success > th,
    .table > tfoot > tr.success > th {
        background-color: #dff0d8;
    }
    .table-hover > tbody > tr > td.success:hover,
    .table-hover > tbody > tr > th.success:hover,
    .table-hover > tbody > tr.success:hover > td,
    .table-hover > tbody > tr:hover > .success,
    .table-hover > tbody > tr.success:hover > th {
        background-color: #d0e9c6;
    }
    .table > thead > tr > td.info,
    .table > tbody > tr > td.info,
    .table > tfoot > tr > td.info,
    .table > thead > tr > th.info,
    .table > tbody > tr > th.info,
    .table > tfoot > tr > th.info,
    .table > thead > tr.info > td,
    .table > tbody > tr.info > td,
    .table > tfoot > tr.info > td,
    .table > thead > tr.info > th,
    .table > tbody > tr.info > th,
    .table > tfoot > tr.info > th {
        background-color: #d9edf7;
    }
    .table-hover > tbody > tr > td.info:hover,
    .table-hover > tbody > tr > th.info:hover,
    .table-hover > tbody > tr.info:hover > td,
    .table-hover > tbody > tr:hover > .info,
    .table-hover > tbody > tr.info:hover > th {
        background-color: #c4e3f3;
    }
    .table > thead > tr > td.warning,
    .table > tbody > tr > td.warning,
    .table > tfoot > tr > td.warning,
    .table > thead > tr > th.warning,
    .table > tbody > tr > th.warning,
    .table > tfoot > tr > th.warning,
    .table > thead > tr.warning > td,
    .table > tbody > tr.warning > td,
    .table > tfoot > tr.warning > td,
    .table > thead > tr.warning > th,
    .table > tbody > tr.warning > th,
    .table > tfoot > tr.warning > th {
        background-color: #fcf8e3;
    }
    .table-hover > tbody > tr > td.warning:hover,
    .table-hover > tbody > tr > th.warning:hover,
    .table-hover > tbody > tr.warning:hover > td,
    .table-hover > tbody > tr:hover > .warning,
    .table-hover > tbody > tr.warning:hover > th {
        background-color: #faf2cc;
    }
    .table > thead > tr > td.danger,
    .table > tbody > tr > td.danger,
    .table > tfoot > tr > td.danger,
    .table > thead > tr > th.danger,
    .table > tbody > tr > th.danger,
    .table > tfoot > tr > th.danger,
    .table > thead > tr.danger > td,
    .table > tbody > tr.danger > td,
    .table > tfoot > tr.danger > td,
    .table > thead > tr.danger > th,
    .table > tbody > tr.danger > th,
    .table > tfoot > tr.danger > th {
        background-color: #f2dede;
    }
    .table-hover > tbody > tr > td.danger:hover,
    .table-hover > tbody > tr > th.danger:hover,
    .table-hover > tbody > tr.danger:hover > td,
    .table-hover > tbody > tr:hover > .danger,
    .table-hover > tbody > tr.danger:hover > th {
        background-color: #ebcccc;
    }
    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }
    @media screen and (max-width: 767px) {
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
        }
        .table-responsive > .table {
            margin-bottom: 0;
        }
        .table-responsive > .table > thead > tr > th,
        .table-responsive > .table > tbody > tr > th,
        .table-responsive > .table > tfoot > tr > th,
        .table-responsive > .table > thead > tr > td,
        .table-responsive > .table > tbody > tr > td,
        .table-responsive > .table > tfoot > tr > td {
            white-space: nowrap;
        }
        .table-responsive > .table-bordered {
            border: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:first-child,
        .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .table-responsive > .table-bordered > thead > tr > td:first-child,
        .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .table-responsive > .table-bordered > tfoot > tr > td:first-child {
            border-left: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:last-child,
        .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .table-responsive > .table-bordered > thead > tr > td:last-child,
        .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .table-responsive > .table-bordered > tfoot > tr > td:last-child {
            border-right: 0;
        }
        .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .table-responsive > .table-bordered > tfoot > tr:last-child > th,
        .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .table-responsive > .table-bordered > tfoot > tr:last-child > td {
            border-bottom: 0;
        }
    }

    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .btn:focus,
    .btn:active:focus,
    .btn.active:focus,
    .btn.focus,
    .btn:active.focus,
    .btn.active.focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }
    .btn:hover,
    .btn:focus,
    .btn.focus {
        color: #333;
        text-decoration: none;
    }
    .btn:active,
    .btn.active {
        background-image: none;
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
    }
    .btn.disabled,
    .btn[disabled],
    fieldset[disabled] .btn {
        cursor: not-allowed;
        filter: alpha(opacity=65);
        -webkit-box-shadow: none;
        box-shadow: none;
        opacity: .65;
    }
    a.btn.disabled,
    fieldset[disabled] a.btn {
        pointer-events: none;
    }
    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .btn-default:focus,
    .btn-default.focus {
        color: #333;
        background-color: #e6e6e6;
        border-color: #8c8c8c;
    }
    .btn-default:hover {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }
    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }
    .btn-default:active:hover,
    .btn-default.active:hover,
    .open > .dropdown-toggle.btn-default:hover,
    .btn-default:active:focus,
    .btn-default.active:focus,
    .open > .dropdown-toggle.btn-default:focus,
    .btn-default:active.focus,
    .btn-default.active.focus,
    .open > .dropdown-toggle.btn-default.focus {
        color: #333;
        background-color: #d4d4d4;
        border-color: #8c8c8c;
    }
    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        background-image: none;
    }
    .btn-default.disabled:hover,
    .btn-default[disabled]:hover,
    fieldset[disabled] .btn-default:hover,
    .btn-default.disabled:focus,
    .btn-default[disabled]:focus,
    fieldset[disabled] .btn-default:focus,
    .btn-default.disabled.focus,
    .btn-default[disabled].focus,
    fieldset[disabled] .btn-default.focus {
        background-color: #fff;
        border-color: #ccc;
    }
    .btn-default .badge {
        color: #fff;
        background-color: #333;
    }
    .btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }
    .btn-primary:focus,
    .btn-primary.focus {
        color: #fff;
        background-color: #286090;
        border-color: #122b40;
    }
    .btn-primary:hover {
        color: #fff;
        background-color: #286090;
        border-color: #204d74;
    }
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        color: #fff;
        background-color: #286090;
        border-color: #204d74;
    }
    .btn-primary:active:hover,
    .btn-primary.active:hover,
    .open > .dropdown-toggle.btn-primary:hover,
    .btn-primary:active:focus,
    .btn-primary.active:focus,
    .open > .dropdown-toggle.btn-primary:focus,
    .btn-primary:active.focus,
    .btn-primary.active.focus,
    .open > .dropdown-toggle.btn-primary.focus {
        color: #fff;
        background-color: #204d74;
        border-color: #122b40;
    }
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        background-image: none;
    }
    .btn-primary.disabled:hover,
    .btn-primary[disabled]:hover,
    fieldset[disabled] .btn-primary:hover,
    .btn-primary.disabled:focus,
    .btn-primary[disabled]:focus,
    fieldset[disabled] .btn-primary:focus,
    .btn-primary.disabled.focus,
    .btn-primary[disabled].focus,
    fieldset[disabled] .btn-primary.focus {
        background-color: #337ab7;
        border-color: #2e6da4;
    }
    .btn-primary .badge {
        color: #337ab7;
        background-color: #fff;
    }
    .btn-success {
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
    }
    .btn-success:focus,
    .btn-success.focus {
        color: #fff;
        background-color: #449d44;
        border-color: #255625;
    }
    .btn-success:hover {
        color: #fff;
        background-color: #449d44;
        border-color: #398439;
    }
    .btn-success:active,
    .btn-success.active,
    .open > .dropdown-toggle.btn-success {
        color: #fff;
        background-color: #449d44;
        border-color: #398439;
    }
    .btn-success:active:hover,
    .btn-success.active:hover,
    .open > .dropdown-toggle.btn-success:hover,
    .btn-success:active:focus,
    .btn-success.active:focus,
    .open > .dropdown-toggle.btn-success:focus,
    .btn-success:active.focus,
    .btn-success.active.focus,
    .open > .dropdown-toggle.btn-success.focus {
        color: #fff;
        background-color: #398439;
        border-color: #255625;
    }
    .btn-success:active,
    .btn-success.active,
    .open > .dropdown-toggle.btn-success {
        background-image: none;
    }
    .btn-success.disabled:hover,
    .btn-success[disabled]:hover,
    fieldset[disabled] .btn-success:hover,
    .btn-success.disabled:focus,
    .btn-success[disabled]:focus,
    fieldset[disabled] .btn-success:focus,
    .btn-success.disabled.focus,
    .btn-success[disabled].focus,
    fieldset[disabled] .btn-success.focus {
        background-color: #5cb85c;
        border-color: #4cae4c;
    }
    .btn-success .badge {
        color: #5cb85c;
        background-color: #fff;
    }
    .btn-info {
        color: #fff;
        background-color: #5bc0de;
        border-color: #46b8da;
    }
    .btn-info:focus,
    .btn-info.focus {
        color: #fff;
        background-color: #31b0d5;
        border-color: #1b6d85;
    }
    .btn-info:hover {
        color: #fff;
        background-color: #31b0d5;
        border-color: #269abc;
    }
    .btn-info:active,
    .btn-info.active,
    .open > .dropdown-toggle.btn-info {
        color: #fff;
        background-color: #31b0d5;
        border-color: #269abc;
    }
    .btn-info:active:hover,
    .btn-info.active:hover,
    .open > .dropdown-toggle.btn-info:hover,
    .btn-info:active:focus,
    .btn-info.active:focus,
    .open > .dropdown-toggle.btn-info:focus,
    .btn-info:active.focus,
    .btn-info.active.focus,
    .open > .dropdown-toggle.btn-info.focus {
        color: #fff;
        background-color: #269abc;
        border-color: #1b6d85;
    }
    .btn-info:active,
    .btn-info.active,
    .open > .dropdown-toggle.btn-info {
        background-image: none;
    }
    .btn-info.disabled:hover,
    .btn-info[disabled]:hover,
    fieldset[disabled] .btn-info:hover,
    .btn-info.disabled:focus,
    .btn-info[disabled]:focus,
    fieldset[disabled] .btn-info:focus,
    .btn-info.disabled.focus,
    .btn-info[disabled].focus,
    fieldset[disabled] .btn-info.focus {
        background-color: #5bc0de;
        border-color: #46b8da;
    }
    .btn-info .badge {
        color: #5bc0de;
        background-color: #fff;
    }
    .btn-warning {
        color: #fff;
        background-color: #f0ad4e;
        border-color: #eea236;
    }
    .btn-warning:focus,
    .btn-warning.focus {
        color: #fff;
        background-color: #ec971f;
        border-color: #985f0d;
    }
    .btn-warning:hover {
        color: #fff;
        background-color: #ec971f;
        border-color: #d58512;
    }
    .btn-warning:active,
    .btn-warning.active,
    .open > .dropdown-toggle.btn-warning {
        color: #fff;
        background-color: #ec971f;
        border-color: #d58512;
    }
    .btn-warning:active:hover,
    .btn-warning.active:hover,
    .open > .dropdown-toggle.btn-warning:hover,
    .btn-warning:active:focus,
    .btn-warning.active:focus,
    .open > .dropdown-toggle.btn-warning:focus,
    .btn-warning:active.focus,
    .btn-warning.active.focus,
    .open > .dropdown-toggle.btn-warning.focus {
        color: #fff;
        background-color: #d58512;
        border-color: #985f0d;
    }
    .btn-warning:active,
    .btn-warning.active,
    .open > .dropdown-toggle.btn-warning {
        background-image: none;
    }
    .btn-warning.disabled:hover,
    .btn-warning[disabled]:hover,
    fieldset[disabled] .btn-warning:hover,
    .btn-warning.disabled:focus,
    .btn-warning[disabled]:focus,
    fieldset[disabled] .btn-warning:focus,
    .btn-warning.disabled.focus,
    .btn-warning[disabled].focus,
    fieldset[disabled] .btn-warning.focus {
        background-color: #f0ad4e;
        border-color: #eea236;
    }
    .btn-warning .badge {
        color: #f0ad4e;
        background-color: #fff;
    }
    .btn-danger {
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
    }
    .btn-danger:focus,
    .btn-danger.focus {
        color: #fff;
        background-color: #c9302c;
        border-color: #761c19;
    }
    .btn-danger:hover {
        color: #fff;
        background-color: #c9302c;
        border-color: #ac2925;
    }
    .btn-danger:active,
    .btn-danger.active,
    .open > .dropdown-toggle.btn-danger {
        color: #fff;
        background-color: #c9302c;
        border-color: #ac2925;
    }
    .btn-danger:active:hover,
    .btn-danger.active:hover,
    .open > .dropdown-toggle.btn-danger:hover,
    .btn-danger:active:focus,
    .btn-danger.active:focus,
    .open > .dropdown-toggle.btn-danger:focus,
    .btn-danger:active.focus,
    .btn-danger.active.focus,
    .open > .dropdown-toggle.btn-danger.focus {
        color: #fff;
        background-color: #ac2925;
        border-color: #761c19;
    }
    .btn-danger:active,
    .btn-danger.active,
    .open > .dropdown-toggle.btn-danger {
        background-image: none;
    }
    .btn-danger.disabled:hover,
    .btn-danger[disabled]:hover,
    fieldset[disabled] .btn-danger:hover,
    .btn-danger.disabled:focus,
    .btn-danger[disabled]:focus,
    fieldset[disabled] .btn-danger:focus,
    .btn-danger.disabled.focus,
    .btn-danger[disabled].focus,
    fieldset[disabled] .btn-danger.focus {
        background-color: #d9534f;
        border-color: #d43f3a;
    }
    .btn-danger .badge {
        color: #d9534f;
        background-color: #fff;
    }
    .btn-link {
        font-weight: normal;
        color: #337ab7;
        border-radius: 0;
    }
    .btn-link,
    .btn-link:active,
    .btn-link.active,
    .btn-link[disabled],
    fieldset[disabled] .btn-link {
        background-color: transparent;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .btn-link,
    .btn-link:hover,
    .btn-link:focus,
    .btn-link:active {
        border-color: transparent;
    }
    .btn-link:hover,
    .btn-link:focus {
        color: #23527c;
        text-decoration: underline;
        background-color: transparent;
    }
    .btn-link[disabled]:hover,
    fieldset[disabled] .btn-link:hover,
    .btn-link[disabled]:focus,
    fieldset[disabled] .btn-link:focus {
        color: #777;
        text-decoration: none;
    }
    .btn-lg,
    .btn-group-lg > .btn {
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.3333333;
        border-radius: 6px;
    }
    .btn-sm,
    .btn-group-sm > .btn {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .btn-xs,
    .btn-group-xs > .btn {
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .btn-block {
        display: block;
        width: 100%;
    }
    .btn-block + .btn-block {
        margin-top: 5px;
    }

    .fade {
        opacity: 0;
        -webkit-transition: opacity .15s linear;
        -o-transition: opacity .15s linear;
        transition: opacity .15s linear;
    }
    .fade.in {
        opacity: 1;
    }
    .collapse {
        display: none;
    }
    .collapse.in {
        display: block;
    }
    tr.collapse.in {
        display: table-row;
    }
    tbody.collapse.in {
        display: table-row-group;
    }

    .caret {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: 2px;
        vertical-align: middle;
        border-top: 4px dashed;
        border-top: 4px solid \9;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
    }

    .open > .dropdown-menu {
        display: block;
    }
    .open > a {
        outline: 0;
    }

    .btn-lg .caret {
        border-width: 5px 5px 0;
        border-bottom-width: 0;
    }
    .dropup .btn-lg .caret {
        border-width: 0 5px 5px;
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    a.label:hover,
    a.label:focus {
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }
    .label:empty {
        display: none;
    }
    .btn .label {
        position: relative;
        top: -1px;
    }
    .label-default {
        background-color: #777;
    }
    .label-default[href]:hover,
    .label-default[href]:focus {
        background-color: #5e5e5e;
    }
    .label-primary {
        background-color: #337ab7;
    }
    .label-primary[href]:hover,
    .label-primary[href]:focus {
        background-color: #286090;
    }
    .label-success {
        background-color: #5cb85c;
    }
    .label-success[href]:hover,
    .label-success[href]:focus {
        background-color: #449d44;
    }
    .label-info {
        background-color: #5bc0de;
    }
    .label-info[href]:hover,
    .label-info[href]:focus {
        background-color: #31b0d5;
    }
    .label-warning {
        background-color: #f0ad4e;
    }
    .label-warning[href]:hover,
    .label-warning[href]:focus {
        background-color: #ec971f;
    }
    .label-danger {
        background-color: #d9534f;
    }
    .label-danger[href]:hover,
    .label-danger[href]:focus {
        background-color: #c9302c;
    }
    .btn .badge {
        position: relative;
        top: -1px;
    }
    .btn-xs .badge,
    .btn-group-xs > .btn .badge {
        top: 0;
        padding: 1px 5px;
    }
    a.badge:hover,
    a.badge:focus {
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }
    .list-group-item.active > .badge,

    .jumbotron {
        padding-top: 30px;
        padding-bottom: 30px;
        margin-bottom: 30px;
        color: inherit;
        background-color: #eee;
    }
    .jumbotron h1,
    .jumbotron .h1 {
        color: inherit;
    }
    .jumbotron p {
        margin-bottom: 15px;
        font-size: 21px;
        font-weight: 200;
    }
    .jumbotron > hr {
        border-top-color: #d5d5d5;
    }
    .container .jumbotron,
    .container-fluid .jumbotron {
        padding-right: 15px;
        padding-left: 15px;
        border-radius: 6px;
    }
    .jumbotron .container {
        max-width: 100%;
    }
    @media screen and (min-width: 768px) {
        .jumbotron {
            padding-top: 48px;
            padding-bottom: 48px;
        }
        .container .jumbotron,
        .container-fluid .jumbotron {
            padding-right: 60px;
            padding-left: 60px;
        }
        .jumbotron h1,
        .jumbotron .h1 {
            font-size: 63px;
        }
    }
    .thumbnail {
        display: block;
        padding: 4px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-transition: border .2s ease-in-out;
        -o-transition: border .2s ease-in-out;
        transition: border .2s ease-in-out;
    }
    .thumbnail > img,
    .thumbnail a > img {
        margin-right: auto;
        margin-left: auto;
    }
    a.thumbnail:hover,
    a.thumbnail:focus,
    a.thumbnail.active {
        border-color: #337ab7;
    }
    .thumbnail .caption {
        padding: 9px;
        color: #333;
    }

    @-webkit-keyframes progress-bar-stripes {
        from {
            background-position: 40px 0;
        }
        to {
            background-position: 0 0;
        }
    }
    @-o-keyframes progress-bar-stripes {
        from {
            background-position: 40px 0;
        }
        to {
            background-position: 0 0;
        }
    }
    @keyframes progress-bar-stripes {
        from {
            background-position: 40px 0;
        }
        to {
            background-position: 0 0;
        }
    }

    .list-group {
        padding-left: 0;
        margin-bottom: 20px;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 10px 15px;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .list-group-item:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    .list-group-item:last-child {
        margin-bottom: 0;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    a.list-group-item,
    button.list-group-item {
        color: #555;
    }
    a.list-group-item .list-group-item-heading,
    button.list-group-item .list-group-item-heading {
        color: #333;
    }
    a.list-group-item:hover,
    button.list-group-item:hover,
    a.list-group-item:focus,
    button.list-group-item:focus {
        color: #555;
        text-decoration: none;
        background-color: #f5f5f5;
    }
    button.list-group-item {
        width: 100%;
        text-align: left;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }
    .panel-body {
        padding: 15px;
    }
    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .panel-heading > .dropdown .dropdown-toggle {
        color: inherit;
    }
    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        color: inherit;
    }
    .panel-title > a,
    .panel-title > small,
    .panel-title > .small,
    .panel-title > small > a,
    .panel-title > .small > a {
        color: inherit;
    }
    .panel-footer {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .panel > .list-group,
    .panel > .panel-collapse > .list-group {
        margin-bottom: 0;
    }
    .panel > .list-group .list-group-item,
    .panel > .panel-collapse > .list-group .list-group-item {
        border-width: 1px 0;
        border-radius: 0;
    }
    .panel > .list-group:first-child .list-group-item:first-child,
    .panel > .panel-collapse > .list-group:first-child .list-group-item:first-child {
        border-top: 0;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .panel > .list-group:last-child .list-group-item:last-child,
    .panel > .panel-collapse > .list-group:last-child .list-group-item:last-child {
        border-bottom: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .panel > .panel-heading + .panel-collapse > .list-group .list-group-item:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .panel-heading + .list-group .list-group-item:first-child {
        border-top-width: 0;
    }
    .list-group + .panel-footer {
        border-top-width: 0;
    }
    .panel > .table,
    .panel > .table-responsive > .table,
    .panel > .panel-collapse > .table {
        margin-bottom: 0;
    }
    .panel > .table caption,
    .panel > .table-responsive > .table caption,
    .panel > .panel-collapse > .table caption {
        padding-right: 15px;
        padding-left: 15px;
    }
    .panel > .table:first-child,
    .panel > .table-responsive:first-child > .table:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .panel > .table:first-child > thead:first-child > tr:first-child,
    .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child,
    .panel > .table:first-child > tbody:first-child > tr:first-child,
    .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .panel > .table:first-child > thead:first-child > tr:first-child td:first-child,
    .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:first-child,
    .panel > .table:first-child > tbody:first-child > tr:first-child td:first-child,
    .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:first-child,
    .panel > .table:first-child > thead:first-child > tr:first-child th:first-child,
    .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:first-child,
    .panel > .table:first-child > tbody:first-child > tr:first-child th:first-child,
    .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:first-child {
        border-top-left-radius: 3px;
    }
    .panel > .table:first-child > thead:first-child > tr:first-child td:last-child,
    .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:last-child,
    .panel > .table:first-child > tbody:first-child > tr:first-child td:last-child,
    .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:last-child,
    .panel > .table:first-child > thead:first-child > tr:first-child th:last-child,
    .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:last-child,
    .panel > .table:first-child > tbody:first-child > tr:first-child th:last-child,
    .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:last-child {
        border-top-right-radius: 3px;
    }
    .panel > .table:last-child,
    .panel > .table-responsive:last-child > .table:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .panel > .table:last-child > tbody:last-child > tr:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child,
    .panel > .table:last-child > tfoot:last-child > tr:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .panel > .table:last-child > tbody:last-child > tr:last-child td:first-child,
    .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:first-child,
    .panel > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
    .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
    .panel > .table:last-child > tbody:last-child > tr:last-child th:first-child,
    .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:first-child,
    .panel > .table:last-child > tfoot:last-child > tr:last-child th:first-child,
    .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:first-child {
        border-bottom-left-radius: 3px;
    }
    .panel > .table:last-child > tbody:last-child > tr:last-child td:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:last-child,
    .panel > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
    .panel > .table:last-child > tbody:last-child > tr:last-child th:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:last-child,
    .panel > .table:last-child > tfoot:last-child > tr:last-child th:last-child,
    .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:last-child {
        border-bottom-right-radius: 3px;
    }
    .panel > .panel-body + .table,
    .panel > .panel-body + .table-responsive,
    .panel > .table + .panel-body,
    .panel > .table-responsive + .panel-body {
        border-top: 1px solid #ddd;
    }
    .panel > .table > tbody:first-child > tr:first-child th,
    .panel > .table > tbody:first-child > tr:first-child td {
        border-top: 0;
    }
    .panel > .table-bordered,
    .panel > .table-responsive > .table-bordered {
        border: 0;
    }
    .panel > .table-bordered > thead > tr > th:first-child,
    .panel > .table-responsive > .table-bordered > thead > tr > th:first-child,
    .panel > .table-bordered > tbody > tr > th:first-child,
    .panel > .table-responsive > .table-bordered > tbody > tr > th:first-child,
    .panel > .table-bordered > tfoot > tr > th:first-child,
    .panel > .table-responsive > .table-bordered > tfoot > tr > th:first-child,
    .panel > .table-bordered > thead > tr > td:first-child,
    .panel > .table-responsive > .table-bordered > thead > tr > td:first-child,
    .panel > .table-bordered > tbody > tr > td:first-child,
    .panel > .table-responsive > .table-bordered > tbody > tr > td:first-child,
    .panel > .table-bordered > tfoot > tr > td:first-child,
    .panel > .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }
    .panel > .table-bordered > thead > tr > th:last-child,
    .panel > .table-responsive > .table-bordered > thead > tr > th:last-child,
    .panel > .table-bordered > tbody > tr > th:last-child,
    .panel > .table-responsive > .table-bordered > tbody > tr > th:last-child,
    .panel > .table-bordered > tfoot > tr > th:last-child,
    .panel > .table-responsive > .table-bordered > tfoot > tr > th:last-child,
    .panel > .table-bordered > thead > tr > td:last-child,
    .panel > .table-responsive > .table-bordered > thead > tr > td:last-child,
    .panel > .table-bordered > tbody > tr > td:last-child,
    .panel > .table-responsive > .table-bordered > tbody > tr > td:last-child,
    .panel > .table-bordered > tfoot > tr > td:last-child,
    .panel > .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }
    .panel > .table-bordered > thead > tr:first-child > td,
    .panel > .table-responsive > .table-bordered > thead > tr:first-child > td,
    .panel > .table-bordered > tbody > tr:first-child > td,
    .panel > .table-responsive > .table-bordered > tbody > tr:first-child > td,
    .panel > .table-bordered > thead > tr:first-child > th,
    .panel > .table-responsive > .table-bordered > thead > tr:first-child > th,
    .panel > .table-bordered > tbody > tr:first-child > th,
    .panel > .table-responsive > .table-bordered > tbody > tr:first-child > th {
        border-bottom: 0;
    }
    .panel > .table-bordered > tbody > tr:last-child > td,
    .panel > .table-responsive > .table-bordered > tbody > tr:last-child > td,
    .panel > .table-bordered > tfoot > tr:last-child > td,
    .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > td,
    .panel > .table-bordered > tbody > tr:last-child > th,
    .panel > .table-responsive > .table-bordered > tbody > tr:last-child > th,
    .panel > .table-bordered > tfoot > tr:last-child > th,
    .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > th {
        border-bottom: 0;
    }
    .panel > .table-responsive {
        margin-bottom: 0;
        border: 0;
    }
    .panel-group {
        margin-bottom: 20px;
    }
    .panel-group .panel {
        margin-bottom: 0;
        border-radius: 4px;
    }
    .panel-group .panel + .panel {
        margin-top: 5px;
    }
    .panel-group .panel-heading {
        border-bottom: 0;
    }
    .panel-group .panel-heading + .panel-collapse > .panel-body,
    .panel-group .panel-heading + .panel-collapse > .list-group {
        border-top: 1px solid #ddd;
    }
    .panel-group .panel-footer {
        border-top: 0;
    }
    .panel-group .panel-footer + .panel-collapse .panel-body {
        border-bottom: 1px solid #ddd;
    }
    .panel-default {
        border-color: #ddd;
    }
    .panel-default > .panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
    }
    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #ddd;
    }
    .panel-default > .panel-heading .badge {
        color: #f5f5f5;
        background-color: #333;
    }
    .panel-default > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #ddd;
    }
    .panel-primary {
        border-color: #337ab7;
    }
    .panel-primary > .panel-heading {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }
    .panel-primary > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #337ab7;
    }
    .panel-primary > .panel-heading .badge {
        color: #337ab7;
        background-color: #fff;
    }
    .panel-primary > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #337ab7;
    }
    .panel-success {
        border-color: #d6e9c6;
    }
    .panel-success > .panel-heading {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    .panel-success > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #d6e9c6;
    }
    .panel-success > .panel-heading .badge {
        color: #dff0d8;
        background-color: #3c763d;
    }
    .panel-success > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #d6e9c6;
    }
    .panel-info {
        border-color: #bce8f1;
    }
    .panel-info > .panel-heading {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }
    .panel-info > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #bce8f1;
    }
    .panel-info > .panel-heading .badge {
        color: #d9edf7;
        background-color: #31708f;
    }
    .panel-info > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #bce8f1;
    }
    .panel-warning {
        border-color: #faebcc;
    }
    .panel-warning > .panel-heading {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
    }
    .panel-warning > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #faebcc;
    }
    .panel-warning > .panel-heading .badge {
        color: #fcf8e3;
        background-color: #8a6d3b;
    }
    .panel-warning > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #faebcc;
    }
    .panel-danger {
        border-color: #ebccd1;
    }
    .panel-danger > .panel-heading {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
    .panel-danger > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #ebccd1;
    }
    .panel-danger > .panel-heading .badge {
        color: #f2dede;
        background-color: #a94442;
    }
    .panel-danger > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #ebccd1;
    }
    .embed-responsive {
        position: relative;
        display: block;
        height: 0;
        padding: 0;
        overflow: hidden;
    }
    .embed-responsive .embed-responsive-item,
    .embed-responsive iframe,
    .embed-responsive embed,
    .embed-responsive object,
    .embed-responsive video {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .embed-responsive-16by9 {
        padding-bottom: 56.25%;
    }
    .embed-responsive-4by3 {
        padding-bottom: 75%;
    }
    .close {
        float: right;
        font-size: 21px;
        font-weight: bold;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        filter: alpha(opacity=20);
        opacity: .2;
    }
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        filter: alpha(opacity=50);
        opacity: .5;
    }
    button.close {
        -webkit-appearance: none;
        padding: 0;
        cursor: pointer;
        background: transparent;
        border: 0;
    }


    .clearfix:before,
    .clearfix:after,
    .dl-horizontal dd:before,
    .dl-horizontal dd:after,
    .container:before,
    .container:after,
    .container-fluid:before,
    .container-fluid:after,
    .row:before,
    .row:after,
    .form-horizontal .form-group:before,
    .form-horizontal .form-group:after,
    .btn-toolbar:before,
    .btn-toolbar:after,
    .btn-group-vertical > .btn-group:before,
    .btn-group-vertical > .btn-group:after,
    .nav:before,
    .nav:after,
    .navbar:before,
    .navbar:after,
    .navbar-header:before,
    .navbar-header:after,
    .navbar-collapse:before,
    .navbar-collapse:after,
    .pager:before,
    .pager:after,
    .panel-body:before,
    .panel-body:after,
    .modal-header:before,
    .modal-header:after,
    .modal-footer:before,
    .modal-footer:after {
        display: table;
        content: " ";
    }
    .clearfix:after,
    .dl-horizontal dd:after,
    .container:after,
    .container-fluid:after,
    .row:after,
    .form-horizontal .form-group:after,
    .btn-toolbar:after,
    .btn-group-vertical > .btn-group:after,
    .nav:after,
    .navbar:after,
    .navbar-header:after,
    .navbar-collapse:after,
    .pager:after,
    .panel-body:after,
    .modal-header:after,
    .modal-footer:after {
        clear: both;
    }
    .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
    .pull-right {
        float: right !important;
    }
    .pull-left {
        float: left !important;
    }
    .hide {
        display: none !important;
    }
    .show {
        display: block !important;
    }
    .invisible {
        visibility: hidden;
    }
    .text-hide {
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }
    .hidden {
        display: none !important;
    }
    .affix {
        position: fixed;
    }
    @-ms-viewport {
        width: device-width;
    }
    .visible-xs,
    .visible-sm,
    .visible-md,
    .visible-lg {
        display: none !important;
    }
    .visible-xs-block,
    .visible-xs-inline,
    .visible-xs-inline-block,
    .visible-sm-block,
    .visible-sm-inline,
    .visible-sm-inline-block,
    .visible-md-block,
    .visible-md-inline,
    .visible-md-inline-block,
    .visible-lg-block,
    .visible-lg-inline,
    .visible-lg-inline-block {
        display: none !important;
    }
    @media (max-width: 767px) {
        .visible-xs {
            display: block !important;
        }
        table.visible-xs {
            display: table !important;
        }
        tr.visible-xs {
            display: table-row !important;
        }
        th.visible-xs,
        td.visible-xs {
            display: table-cell !important;
        }
    }
    @media (max-width: 767px) {
        .visible-xs-block {
            display: block !important;
        }
    }
    @media (max-width: 767px) {
        .visible-xs-inline {
            display: inline !important;
        }
    }
    @media (max-width: 767px) {
        .visible-xs-inline-block {
            display: inline-block !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table !important;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .visible-sm-block {
            display: block !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .visible-sm-inline {
            display: inline !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .visible-sm-inline-block {
            display: inline-block !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .visible-md {
            display: block !important;
        }
        table.visible-md {
            display: table !important;
        }
        tr.visible-md {
            display: table-row !important;
        }
        th.visible-md,
        td.visible-md {
            display: table-cell !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .visible-md-block {
            display: block !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .visible-md-inline {
            display: inline !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .visible-md-inline-block {
            display: inline-block !important;
        }
    }
    @media (min-width: 1200px) {
        .visible-lg {
            display: block !important;
        }
        table.visible-lg {
            display: table !important;
        }
        tr.visible-lg {
            display: table-row !important;
        }
        th.visible-lg,
        td.visible-lg {
            display: table-cell !important;
        }
    }
    @media (min-width: 1200px) {
        .visible-lg-block {
            display: block !important;
        }
    }
    @media (min-width: 1200px) {
        .visible-lg-inline {
            display: inline !important;
        }
    }
    @media (min-width: 1200px) {
        .visible-lg-inline-block {
            display: inline-block !important;
        }
    }
    @media (max-width: 767px) {
        .hidden-xs {
            display: none !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .hidden-sm {
            display: none !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .hidden-md {
            display: none !important;
        }
    }
    @media (min-width: 1200px) {
        .hidden-lg {
            display: none !important;
        }
    }
    .visible-print {
        display: none !important;
    }

    /*# sourceMappingURL=bootstrap.css.map */
    /*!
         * @package   yii2-grid
         * @author    Kartik Visweswaran <kartikv2@gmail.com>
         * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
         * @version   3.1.4
         *
         * Gridview widget styling and enhancements for Bootstrap.
         * Built for Yii Framework 2.0
         * Author: Kartik Visweswaran
         * Year: 2015
         * For more Yii related demos visit http://demos.krajee.com
         */

    /**
         * Panel Styles
         */
    .kv-panel-pager {
        min-height: 34px;
    }

    .kv-panel-pager .pagination {
        margin: 0 0 -5px 0;
        padding: 0;
    }

    .kv-panel-before {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .kv-panel-after {
        padding: 10px;
        border-top: 1px solid #ddd;
    }

    .kv-table-float {
        border-top: none;
        border-bottom: none;
        background-color: #fff;
    }

    .kv-align-center {
        text-align: center;
    }

    .kv-align-left {
        text-align: left;
    }

    .kv-align-right {
        text-align: right;
    }

    .kv-align-top {
        vertical-align: top !important;
    }

    .kv-align-bottom {
        vertical-align: bottom !important;
    }

    .kv-align-middle {
        vertical-align: middle !important;
    }

    .kv-nowrap {
        white-space: nowrap;
    }

    .kv-merged-header {
        border-bottom: 2px solid #ddd !important;
    }

    .kv-page-summary {
        border-top: 4px double #ddd;
        font-weight: bold;
    }

    .kv-table-footer {
        border-top: 4px double #ddd;
        font-weight: bold;
    }

    .kv-table-caption {
        font-size: 1.5em;
        padding: 8px;
        border: 1px solid #ddd;
        border-bottom: none;
        text-align: center;
    }

    .panel .kv-table-caption {
        border: none;
        border-bottom: 1px solid #ddd;
    }

    .kv-grid-loading {
        opacity: 0.5;
        background: #ffffff url('../img/loading.gif') center center no-repeat !important;
    }

    .kv-grid-loading tr, .kv-grid-loading td {
        background: transparent !important;
    }

    .kv-grid-loading td {
        border-color: #efefef !important;
    }

    .kv-grid-hide {
        display: none !important;
    }

    .kv-grid-toolbar .dropdown-menu {
        z-index: 1025;
    }

    .panel > .floatThead-wrapper > .table,
    .panel .table-responsive > .floatThead-wrapper > .table,
    .panel > .panel-collapse > .table {
        margin-bottom: 0;
    }

    .panel > .floatThead-wrapper > .table caption,
    .panel .table-responsive > .floatThead-wrapper > .table caption,
    .panel > .panel-collapse > .table caption {
        padding-right: 15px;
        padding-left: 15px;
    }

    .panel > .floatThead-wrapper > .table:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:first-child > thead:first-child > tr:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > thead:first-child > tr:first-child,
    .panel > .floatThead-wrapper > .table:first-child > tbody:first-child > tr:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > tbody:first-child > tr:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:first-child > thead:first-child > tr:first-child td:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > thead:first-child > tr:first-child td:first-child,
    .panel > .floatThead-wrapper > .table:first-child > tbody:first-child > tr:first-child td:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > tbody:first-child > tr:first-child td:first-child,
    .panel > .floatThead-wrapper > .table:first-child > thead:first-child > tr:first-child th:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > thead:first-child > tr:first-child th:first-child,
    .panel > .floatThead-wrapper > .table:first-child > tbody:first-child > tr:first-child th:first-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > tbody:first-child > tr:first-child th:first-child {
        border-top-left-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:first-child > thead:first-child > tr:first-child td:last-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > thead:first-child > tr:first-child td:last-child,
    .panel > .floatThead-wrapper > .table:first-child > tbody:first-child > tr:first-child td:last-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > tbody:first-child > tr:first-child td:last-child,
    .panel > .floatThead-wrapper > .table:first-child > thead:first-child > tr:first-child th:last-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > thead:first-child > tr:first-child th:last-child,
    .panel > .floatThead-wrapper > .table:first-child > tbody:first-child > tr:first-child th:last-child,
    .panel > .table-responsive > .floatThead-wrapper:first-child > .table:first-child > tbody:first-child > tr:first-child th:last-child {
        border-top-right-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:last-child > tbody:last-child > tr:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tbody:last-child > tr:last-child,
    .panel > .floatThead-wrapper > .table:last-child > tfoot:last-child > tr:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tfoot:last-child > tr:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:last-child > tbody:last-child > tr:last-child td:first-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tbody:last-child > tr:last-child td:first-child,
    .panel > .floatThead-wrapper > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
    .panel > .floatThead-wrapper > .table:last-child > tbody:last-child > tr:last-child th:first-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tbody:last-child > tr:last-child th:first-child,
    .panel > .floatThead-wrapper > .table:last-child > tfoot:last-child > tr:last-child th:first-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tfoot:last-child > tr:last-child th:first-child {
        border-bottom-left-radius: 3px;
    }

    .panel > .floatThead-wrapper > .table:last-child > tbody:last-child > tr:last-child td:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tbody:last-child > tr:last-child td:last-child,
    .panel > .floatThead-wrapper > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
    .panel > .floatThead-wrapper > .table:last-child > tbody:last-child > tr:last-child th:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tbody:last-child > tr:last-child th:last-child,
    .panel > .floatThead-wrapper > .table:last-child > tfoot:last-child > tr:last-child th:last-child,
    .panel > .table-responsive > .floatThead-wrapper:last-child > .table:last-child > tfoot:last-child > tr:last-child th:last-child {
        border-bottom-right-radius: 3px;
    }

    .panel > .panel-body + .table,
    .panel > .panel-body + .table-responsive,
    .panel > .floatThead-wrapper > .table + .panel-body,
    .panel > .table-responsive > .floatThead-wrapper + .panel-body {
        border-top: 1px solid #ddd;
    }

    .panel > .floatThead-wrapper > .table > tbody:first-child > tr:first-child th,
    .panel > .floatThead-wrapper > .table > tbody:first-child > tr:first-child td {
        border-top: 0;
    }

    .panel > .floatThead-wrapper > .table-bordered,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered {
        border: 0;
    }

    .panel > .floatThead-wrapper > .table-bordered > thead > tr > th:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr > th:first-child,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr > th:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr > th:first-child,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr > th:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr > th:first-child,
    .panel > .floatThead-wrapper > .table-bordered > thead > tr > td:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr > td:first-child,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr > td:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr > td:first-child,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr > td:first-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }

    .panel > .floatThead-wrapper > .table-bordered > thead > tr > th:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr > th:last-child,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr > th:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr > th:last-child,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr > th:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr > th:last-child,
    .panel > .floatThead-wrapper > .table-bordered > thead > tr > td:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr > td:last-child,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr > td:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr > td:last-child,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr > td:last-child,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }

    .panel > .floatThead-wrapper > .table-bordered > thead > tr:first-child > td,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr:first-child > td,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr:first-child > td,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr:first-child > td,
    .panel > .floatThead-wrapper > .table-bordered > thead > tr:first-child > th,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > thead > tr:first-child > th,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr:first-child > th,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr:first-child > th {
        border-bottom: 0;
    }

    .panel > .floatThead-wrapper > .table-bordered > tbody > tr:last-child > td,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr:last-child > td,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr:last-child > td,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr:last-child > td,
    .panel > .floatThead-wrapper > .table-bordered > tbody > tr:last-child > th,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tbody > tr:last-child > th,
    .panel > .floatThead-wrapper > .table-bordered > tfoot > tr:last-child > th,
    .panel .table-responsive > .floatThead-wrapper > .table-bordered > tfoot > tr:last-child > th {
        border-bottom: 0;
        border-radius: 3px;
    }

    /**
         * Responsive table wrapping
         */
    @media screen and (max-width: 480px) {
        .kv-table-wrap th, .kv-table-wrap td {
            display: block;
            width: 100%!important;
            text-align: center;
            font-size: 1.2em;
        }
        .kv-table-wrap tr > td:first-child {
            border-top: 3px double #ccc;
            margin-top: 10px;
            font-size: 2em;
        }
    }

    /**
         * RadioColumn styles
         */
    .kv-clear-radio {
        float:none;
    }

    /**
         * Grid Grouping Styles
         */
    td.kv-group-even {
        background-color: #f0f1ff!important;
    }

    .table-hover td.kv-group-even:hover {
        background-color: #d7d9ff!important;
    }

    td.kv-group-odd {
        background-color: #f9fcff!important;
    }

    .table-hover td.kv-group-odd:hover {
        background-color: #d7ecff!important;
    }

    .kv-grouped-row {
        background-color: #FFF0F5!important;
        font-size: 1.3em;
        padding-top: 10px!important;
        padding-bottom: 10px!important;
    }

    .table-hover .kv-grouped-row:hover {
        background-color: #FFE4E1!important;
    }

    /**
         * Grid styles for floating header and perfect scrollbar
         */
    .kv-grid-wrapper {
        position: relative;
        overflow: auto;
        height: 300px;
    }

    /**
         * Fix overflow and make layout responsive for mobile/small devices
         */
    @media (max-width:768px) {
        .hide-resize .rc-handle-container {
            overflow: hidden;
        }
    }
</style>
    <div class = "container-fluid">

        <?php $this->beginBody() ?>
            <?= $content ?>
        <?php $this->endBody() ?>

        <table class="footer-wrap" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; clear: both !important; margin: 0; padding: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
                <td class="container" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto; padding: 0;">
                    <div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        <table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 0;">
                            <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
                                <td align="center" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; color: #666; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        © <?= Yii::$app->name ?> <?= date('Y') ?>.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
            </tr>
        </table>

    </div>
</body>
</html>
<?php $this->endPage() ?>
