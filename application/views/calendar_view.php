<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>


<style>
    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .team-member-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #e9ecef;
    }

    .team-member-info {
        flex-grow: 1;
    }
</style>

<!-- Shiv Web Developer -->
<style>
    @media (min-width: 1200px) {
        main .page-body {
            height: calc(100vh - 30px) !important;
        }
    }

    #filtersSection {
        margin-top: 0 !important;
    }

    .filters .filter-box {
        padding-bottom: 12px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 43px;
        height: 100%;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
        height: 17px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 50%;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .custom-search-input {
        padding-left: 2.2rem;
    }

    .custom-search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: gray;
        pointer-events: none;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .container {
            padding: 10px;
        }

        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-8 {
            margin-bottom: 15px;
        }

        .mt--48 {
            margin-top: 15px !important;
        }
    }

    @media (max-width: 768px) {
        .form-unique {
            width: 25px !important;
            height: 25px;
            font-size: 12px !important;
        }

        .d-flex.gap-3 {
            flex-direction: column;
        }

        .top-right-btns {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .top-right-btns button {
            flex: 1;
        }

        .ps-md-3 {
            padding-left: 10px !important;
        }

        .p-md-5 {
            padding: 15px !important;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 5px;
        }

        .form-unique {
            width: 20px !important;
            height: 20px;
            font-size: 10px !important;
            margin: 0 1px;
        }

        .custom-upload-btn {
            font-size: 12px;
            padding: 5px 8px;
        }

        h4 {
            font-size: 18px;
        }

        label {
            font-size: 14px;
        }
    }

    /* New styles for modals and upload icons */
    .upload-modal .modal-content {
        border-radius: 10px;
    }

    .upload-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .upload-modal .modal-body {
        padding: 20px;
    }

    .textarea-upload-container {
        position: relative;
    }

    .mic-icon,
    .video-icon,
    .upload-icon {
        position: absolute;
        cursor: pointer;
        font-size: 18px;
        color: rgb(0, 127, 230);
    }

    .mic-icon {
        right: 19px;
        top: 10px;
    }

    .video-icon {
        left: 12px;
        bottom: 12px;
    }

    .upload-icon {
        right: 12px;
        bottom: 12px;
    }
</style>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f4f6f8;
        margin: 0;
    }

    .container {
        display: flex;
        margin: 20px auto;
        max-width: 95%;
        gap: 20px;
    }

    #sidebar {
        width: 280px;
        flex-shrink: 0;
    }

    #miniCalendar {
        background: #fff;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    #miniHeader {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        font-weight: 600;
    }

    #miniHeader button {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #333;
    }

    #miniHeader button:hover {
        color: #007bff;
    }

    #miniGrid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
        text-align: center;
        font-size: 13px;
    }

    .fc-view-harness {
        margin-top: 14px;
    }

    .fc .fc-button-primary {
        background-color: white !important;
        border-color: black !important;
        color: black !important;
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active:focus,
    .fc .fc-button-primary:not(:disabled):active:focus {
        background-color: #04d6e5ff !important;
        color: white !important;
        box-shadow: none !important;
    }

    #miniGrid div {
        padding: 5px;
        border-radius: 6px;
        cursor: pointer;
    }

    #miniGrid .today {
        background: #007bff;
        color: #fff;
        font-weight: bold;
    }

    #miniGrid .selected {
        background: #e3f2fd;
        color: #007bff;
        font-weight: 600;
    }

    #calendarWrapper {
        flex-grow: 1;
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        /* box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08); */
        position: relative;
    }

    #calendar {
        margin-top: 0px;
    }

    /* 🆕 Remaining Days Info */
    #remainingDays {
        position: absolute;
        top: 100px;
        right: 228px;
        background: #04d6e5ff;
        color: #ffffffff;
        padding: 5px 20px;
        border-radius: 0px;
        font-size: 16px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }


    /* === Modal Styles === */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 700px;
        max-width: 90%;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        opacity: 1;
        animation: fadeIn 0.2s ease-in-out;
    }

    .modal-header {
        font-weight: bold;
        font-size: 18px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body p {
        margin: 6px 0;
        color: #333;
    }

    .modal-footer {
        text-align: right;
        margin-top: 10px;
    }

    /* .btn-close {
        background: #007bff !important;
        color: #fff !important;
        border: none !important;
        padding: 5px 16px 10px 16px !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        font-size: 14px !important;
        width: 70px !important;
        opacity: 1 !important;
    }

    .btn-close:hover {
        background: #068febff !important;
        opacity: 1 !important;
    } */

    #previewIcon {
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        color: #007bff;
    }

    #previewIcon:hover {
        color: #0056b3;
    }

    @keyframes fadeIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }


    #remainingInfo {
        position: absolute;
        top: 107px;
        right: 112px;
        display: flex;
        gap: 15px;
    }

    #remainingMonthsBox {
        background: white;
        color: black;
        padding: 6px 23px;
        border-radius: 0px 0px 3px 3px;
        font-size: 15px;
        width: 57px;
        font-weight: 500;
        border: 1px solid black;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        margin-right: 118px;
    }

    #remainingDaysBox {
        background: white;
        color: black;
        width: 53px;
        padding: 6px 15px;
        border-radius: 0px 0px 3px 3px;
        border-radius: 0px;
        border: 1px solid black;
        font-size: 15px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    #calendarFilters {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-filter {
        background-color: #04d6e5ff;
        color: #fff;
        border: none;
        padding: 6px 16px;
        border-radius: 0px;
        cursor: pointer;
        transition: 0.2s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-filter:hover {
        background-color: #04d6e5ff;
    }

    .btn-filter.active {
        background-color: #04d6e5ff;
    }


    /* Modal background */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
        /* display: flex; */
        /* align-items: center; */
        /* justify-content: center; */
    }

    /* Modal box */
    .modal-content {
        background: #fff;
        overflow-y: scroll;
        max-width: 95%;
        max-height: 95vh;
        width: auto;
        /* margin: 10% auto; */
        padding: 8px;
        border-radius: 12px;
        position: relative;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease;
        margin: auto;
        /* display: flex; */
        /* flex-direction: column; */
        /* overflow: hidden; */
    }

    /* Modal fade animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Close button */
    .close-btn {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 22px;
        color: #333;
        cursor: pointer;
        font-weight: bold;
    }

    .close-btn:hover {
        color: #000;
    }

    /* Time list */
    .time-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
        border-top: 0.5px solid #b8b8b8ff;
        border-bottom: 0.5px solid #b5b3b3ff;
    }

    .time-list li {
        padding: 6px 10px;
        border-bottom: 1px solid #eee;
        font-size: 15px;
    }

    .time-list li:last-child {
        border-bottom: none;
    }

    h3 {
        margin-bottom: 15px;
    }

    #closeTimeStamp {
        font-size: 20px !important;
        font-weight: 800 !important;
        position: absolute;
        top: 25px;
        right: 30px;
        cursor: pointer;
    }

    #closeTimeStampFuture {
        font-size: 20px !important;
        font-weight: 800 !important;
        position: absolute;
        top: 25px;
        right: 30px;
        cursor: pointer;
    }

    #closeDataFeedingModal {
        font-size: 20px !important;
        font-weight: 800 !important;
        position: absolute;
        top: 25px;
        right: 30px;
        cursor: pointer;
    }

    #closeEditTaskModal {
        font-size: 20px !important;
        font-weight: 800 !important;
        position: absolute;
        top: 25px;
        right: 30px;
        cursor: pointer;
    }

    .borderBoxesAreaContainer {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 10px;
        min-height: 50px;
        margin-bottom: 10px;
    }


    .time-list li {
        position: relative;
        padding: 18px 0;
        border-bottom: 1px solid #eee;
    }

    .event-box {
        position: absolute;
        left: 120px;
        top: 2px;
        width: 65%;
        background: #1e88e5;
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
    }

    .time-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* gap: 34px; */
    }

    .time-list li {
        padding: 13px 0;
        border-bottom: 1px solid #e3e3e3;
    }

    .minutes_showcase_area {
        padding: 0px 10px;
        z-index: 1;
        /* width: 300px; */
        /* margin-left: 30px; */
    }

    .minutes_showcase_area span span {
        position: absolute;
        width: 34.6vw;
        height: inherit;
        background: #e3e3e3;
        left: 100%;
    }
    .bodycontentforModel{
        margin-top: 40px;
    }
    .calender_task_profile_pic{
        width: 30px;
        height: 30px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
    }
    .btn-primary i{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 20px;
        height: 18px;
    }
</style>

<style>
    .globallySearchFilter {
        border-radius: 30px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        padding: 10px 20px;
        background-color: white;
        position: absolute;
        top: -40px;
        width: 80%;
        display: none;
    }

    .globallySearchFilter input {
        border: none;
        outline: none;
        border-radius: 0;
        box-shadow: none;
    }

    .globallySearchFilter input:focus,
    .globallySearchFilter input:active,
    .globallySearchFilter input:hover {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }

    .globallySearchFilterContainer {
        position: relative;
    }

    .searchCloseBtn {
        position: absolute;
        top: -20px;
        left: -20px;
        background-color: white;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border-radius: 100%;
        padding: 2px 8px;
        cursor: pointer;
    }

    .globallySearchFilter {
        display: none;
        opacity: 0;
        transition: 0.3s ease;
    }

    .globallySearchFilter.active {
        display: block;
        opacity: 1;
    }
</style>

<style>
    .minutes_showcase_area {
        display: none;
    }

    .minutes_showcase_area.active {
        display: block;
    }

    /* .time-list li {
        height: 40px;
    } */

    /* .time-list li:hover {
        height: 300px;
    } */

    #timeContainer {
        position: relative;
    }

    .time-label-container {
        position: absolute;
        left: 10px;
        top: 0%;
        transform: translateY(-50%);
        font-weight: bold;
        color: #000000ff;
    }

    .toggle-button-container {
        position: absolute;
        left: 135px;
        top: 0%;
        transform: translateY(-50%);
        font-weight: bold;
        color: #000000ff;
    }

    .toggle-button-container-right {
        position: absolute;
        left: 58%;
        top: 0%;
        transform: translateY(-50%);
        font-weight: bold;
        color: #000000ff;
    }

    .timeandminutesbiffercate {
        height: 100%;
        width: 1px;
        background-color: #e3dfdfff;
        position: absolute;
        left: 73px;
        top: -16px;
    }

    .timeandminutesbiffercateright {
        height: 100%;
        width: 1px;
        background-color: #d6d6d6ff;
        position: absolute;
        left: 183px;
        top: -16px;
    }

    .timeandminutesbiffercatepm {
        height: 100%;
        width: 1px;
        background-color: #e3dfdfff;
        position: absolute;
        left: 50%;
        top: -16px;
    }

    .timeandminutesbiffercatepmright {
        height: 100%;
        width: 1px;
        background-color: #e3dfdfff;
        position: absolute;
        left: 54.8%;
        top: -16px;
    }

    .timeandminutesbiffercatepmright2 {
        height: 100%;
        width: 1px;
        background-color: #e3dfdfff;
        position: absolute;
        left: 61.4%;
        top: -16px;
    }

    /* DEVIDED BY 60 LINES */
    .timingshowcase_date {
        position: relative;
        height: 100px;
        /* any height you want */
        list-style: none;
        padding-left: 60px;
        /* space for time text */
    }

    /* container that splits height into 60 lines */
    .minutes_showcase_area {
        position: relative;
        /* top: 0; */
        /* left: 40px; */
        height: 100%;
        /* width: 120px; */
        /* display: grid;
        grid-template-rows: repeat(60, 1fr); */
        /* 👈 divide into 60 equal rows */
        /* gap: 2px; */
        display: flex;
        flex-direction: column;
    }

    /* single minute line */
    .minute-line {
        display: block;
        width: 100%;
        height: 1px;
        transform: scaleY(2);
        transform-origin: top;
        background: #37daffff;
        border-radius: 2px;
        margin-bottom: 4px;
        z-index: 1;
    }

    .minute-line span {
        display: none;
    }

    /* VERTICLE LINE  */
    .minutes_showcase_area_content {
        position: relative;
        /* left: 23%;
        top: -36px; */
        /* display: flex; */
        display: grid;
        grid-template-columns: repeat(9, 1fr);
        /* width: 70%; */
        height: 100%;
    }

    .minutes_showcase_area_content::before {
        /* content: ""; */
        /* position: absolute; */
        inset: 0;
        background: repeating-linear-gradient(to bottom,
                transparent 0,
                transparent 29px,
                #eee 30px);
    }

    .section_saprate {
        flex: 1;
        position: relative;
    }

    .section_saprate::after {
        content: "";
        position: absolute;
        right: 0;
        top: 0;
        width: 0.5px;
        height: 100%;
        background: #000;
        /* line color */
    }

    .time-input {
        width: 130px;
    }
</style>

<style>
    select:disabled {
        background-color: #e9ecef;
        /* light gray blur */
        color: #6c757d;
    }
</style>

<style>
    .chat-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
    }

    .chat-modal-content {
        background: #fff;
        width: 90%;
        padding: 20px;
        border-radius: 6px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .chat-close {
        position: absolute;
        right: 12px;
        top: 8px;
        font-size: 22px;
        cursor: pointer;
    }

    .last-line {
        /* border: 2px solid grey; */
        background: grey;
        height: 2px;
        position: absolute;
        bottom: 3px;
        /* width: 47vw; */
        left: -51%;
        width: 45.4vw;
    }

    #amToggleBtn {
        transform: translate(-40%, -50%);
        left: 8%;
    }

    .dot {
        width: 10px;
        height: 10px;
        background-color: #04d6e5;
        border-radius: 50%;
        position: absolute;
        left: 6px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    .dropped-item:not(:last-child)::after {
        content: "";
        position: absolute;
        left: 10px;          /* center with dot */
        top: 50%;
        width: 2px;
        height: calc(100% + 16px); /* distance to next item */
        background-color: #04d6e5;
        z-index: 1;
    }

    .content_adding__container {
        position: relative;
    }
    .dropped-item{
        position: relative;
        display: grid;
        grid-template-rows: 1;
        grid-template-columns: 2;
        align-items: center;
        gap: 10px;
        padding-left: 25px;
    }
    .w-fill-content{
        width: fit-content !important;
    }
    .timeline-output{
        display: flex;
        gap: 3px;
    }
    .edit-item{
        z-index: 50;
    }
</style>

<style>
    table[role='grid'] thead {
        display: none;
    }

    table[role='grid'] tbody {
        height: 500px;
    }

    table[role='presentation'] tr {
        display: flex;
        flex-direction: column;
    }

    .fc-daygrid-day-top {
        justify-content: start;
    }

    .fc .fc-scroller-liquid-absolute {
        position: relative;
    }

    .fc-header-toolbar {
        flex-direction: column-reverse;
        gap: 18px;
    }

    .fc-theme-standard td {
        width: 82vw;
    }
</style>

<style>
    .timeline_container{
        /* border: 1px solid #e3e3e3; */
        /* background: #f8f9fa; */
        padding: 28px 48px;
        position: relative;
        z-index: 2;
        background: transparent !important;
    }
    .timeline_wrapper{
        position: relative;
        min-height: 500px;
        background: #f8f9fa;
        z-index: 0;
    }
    #connectionLayer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        overflow: visible;  
    }
    .my_timeline{
        position: relative;
        height: 1px;
        display: flex;
        justify-content: space-evenly;
    }
    .my_timeline_line{
        position: absolute;
        height: 1px;
        width: 100%;
        background: #e3e3e3;
    }
    .context-menu {
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        display: none;
        z-index: 1000;
        width: 200px;
    }
    .context-menu ul {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }

    .context-menu li {
        padding: 6px 12px;
        cursor: pointer;
    }

    .context-menu li:hover {
        background: #f1f1f1;
    }

    .menu-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .menu-item:hover {
        background: #f0f0f0;
    }

    .timeline-users {
        display: inline-flex;
        gap: 20px;
        height: 50px;
        width: 100%;
        justify-content: center;
        position: absolute;
        top: 35px;
        transform: translate(0px, -50%);
        align-items: center;
        flex-direction: row;
    }

    .timeline-user {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        max-width: 75px;
        min-width: 75px;
        padding: 4px 8px;
        /* background: #fff; */
        border-radius: 20px;
        cursor: grab;
    }

    .timeline-user a {
        text-align: center;
        text-decoration: none;
        color: black;
    }

    .timeline-user a .user-avatar {
        width: 35px;
        height: 35px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
        /* border: 1px solid blue; */
    }

    .timeline-user a span {
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
    }

    .tagify__input {
        background: gainsboro;
        min-width: 150px;
    }

    .timeline-user.dragging {
        opacity: 0.5;
    }

    .connection-source {
        border: 3px solid #0d6efd !important; /* Blue border */
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        background-color: #e9ecef;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

    .search-btn{
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 50%;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    .search-btn:hover{
      background-color: white; 
    }

    .project-row-one {
		position: relative;
		display: grid;
		grid-template-columns: auto 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-two {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-three {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-four {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-row-five {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}
	.project-row-six {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-cell {
		padding: 3px 10px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.project-cell.index {
		border-right: 1px solid #ccc;
		text-align: center;
	}

	.eye-icon {
		font-size: 16px;
		color: #00a7cc;
	}

	.project-grid-bottom-1 {
		grid-template-columns: 30px repeat(4, 1fr);
	}

    .fc-media-screen{
        /* width: 100vw; */
        justify-content: center;
    }

    .event-count-badge {
        background: #00a7cc;
        color: #fff;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 8px;
        margin-left: 6px;
        opacity: 0.9;
        pointer-events: none;
    }

    .fc .fc-daygrid-day-top{
        align-items:center;
        flex-direction: row;
        gap: 8px;
    }

    #monthlyDownloadModal {
        display: none;                /* hidden by default */
        position: fixed;
        inset: 0;                     /* top:0; right:0; bottom:0; left:0 */
        background: rgba(0,0,0,0.5);  /* overlay */
        z-index: 1050;
    }

    #monthlyDownloadModal .modal-content {
        background: #fff;
        max-width: 420px;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 43px;
        height: 100%;
    }
    .table{
        top: 0px;
        left: unset;
        transform: unset;
        width: auto;
        height: auto;
    }
</style>

<div class="page-body pt-1 px-2">
    <div class="row align-items-start">
        <div class="col-md-3">
            <!-- Left Sidebar -->
            <div id="sidebar">
                <div id="miniCalendar">
                    <div id="miniHeader">
                        <button id="prevMonth">&#8249;</button>
                        <span id="miniMonth"></span>
                        <button id="nextMonth">&#8250;</button>
                    </div>
                    <div id="miniGrid"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Main Calendar -->
            <div id="calendarWrapper">
                <div id="remainingInfo">
                    <div id="remainingMonthsBox"></div>
                    <div id="remainingDaysBox"></div>
                </div>
                <!-- 🆕 Filter Buttons -->
                <div id="calendarFilters" style="margin-bottom: 15px; text-align: right;">
                    <button class="btn-filter" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                        Book Appointment
                    </button>
                    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="appointmentModalLabel">Appointment Booking Modal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-start">
                                    <div class="mb-3">
                                        <label class="form-label">Book Appointment For</label>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="bookingTypeSwitch">
                                            <label class="form-check-label" for="bookingTypeSwitch">
                                                Toggle to Book for User
                                            </label>
                                        </div>

                                    </div>

                                    <form id="appointmentForm">
                                        <div id="company_booking_section">
                                            <div class="mb-3">
                                                <label class="form-label">Company</label>
                                                    <select class="form-select" aria-label="Company Search" id="selected_company">
                                                        <option value="" selected>Select Company</option>
                                                        <?php foreach($companies as $c) : ?>
                                                            <option value="<?= $c['id'] ?>"><?= $c['company_name'] ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <button type="button" id="search_project_btn" class="btn btn-info btn-sm text-white mt-2">Search Project</button>
                                            </div>

                                            <div id="projects_container" class="mb-3">
                                                
                                            </div>
                                        </div>    
                                        <div id="user_booking_section" style="display:none;">

                                            <div class="mb-3">
                                                <label class="form-label">Select User</label>

                                                <input class="form-control" id="team-member-input" name='user_search' placeholder='Search user by name' value=''>

                                            </div>

                                        </div>                                    

                                        <div class="mb-3">
                                            <label class="form-label">Start Date Time</label>
                                            <input type="datetime-local" name="appointment_start_date_time" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">End Date Time</label>
                                            <input type="datetime-local" name="appointment_end_date_time" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" class="form-label">Notes</label>
                                            <textarea name="notes" class="form-control"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="bid">Bid</label>
                                            <div class="row m-0">
                                                <div class="col-3 p-0">
                                                    <select class="form-select" name="currency_symbol" id="currency-symbol" value=""style="margin-right:=10px;">
                                                        <option value="">Currency</option>
                                                        <option value="USD|$">$ – US Dollar</option>
                                                        <option value="EUR|€">€ – Euro</option>
                                                        <option value="GBP|£">£ – British Pound</option>
                                                        <option value="INR|₹">₹ – Indian Rupee</option>
                                                        <option value="AUD|$">$ – Australian Dollar</option>
                                                        <option value="CAD|$">$ – Canadian Dollar</option>
                                                        <option value="SGD|$">$ – Singapore Dollar</option>
                                                        <option value="NZD|$">$ – New Zealand Dollar</option>
                                                        <option value="JPY|¥">¥ – Japanese Yen</option>
                                                        <option value="CNY|¥">¥ – Chinese Yuan</option>
                                                        <option value="CHF|CHF">CHF – Swiss Franc</option>
                                                        <option value="HKD|$">$ – Hong Kong Dollar</option>
                                                        <option value="AED|د.إ">د.إ – UAE Dirham</option>
                                                        <option value="SAR|﷼">﷼ – Saudi Riyal</option>
                                                        <option value="QAR|﷼">﷼ – Qatari Riyal</option>
                                                        <option value="OMR|﷼">﷼ – Omani Rial</option>
                                                        <option value="KWD|KD">KD – Kuwaiti Dinar</option>
                                                        <option value="BHD|BD">BD – Bahraini Dinar</option>
                                                        <option value="TRY|₺">₺ – Turkish Lira</option>
                                                        <option value="RUB|₽">₽ – Russian Ruble</option>
                                                        <option value="ZAR|R">R – South African Rand</option>
                                                        <option value="THB|฿">฿ – Thai Baht</option>
                                                        <option value="MYR|RM">RM – Malaysian Ringgit</option>
                                                        <option value="IDR|Rp">Rp – Indonesian Rupiah</option>
                                                        <option value="PKR|₨">₨ – Pakistani Rupee</option>
                                                        <option value="BDT|৳">৳ – Bangladeshi Taka</option>
                                                        <option value="KRW|₩">₩ – South Korean Won</option>
                                                        <option value="NGN|₦">₦ – Nigerian Naira</option>
                                                        <option value="PHP|₱">₱ – Philippine Peso</option>
                                                        <option value="VND|₫">₫ – Vietnamese Dong</option>
                                                        <option value="ILS|₪">₪ – Israeli Shekel</option>
                                                    </select>
                                                </div>
                                                <div class="col-9 p-0">
                                                    <input class="form-control" type="number" max="999999999999" min="0" name="bid_amount" id="bid">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="barter">Barter/Deal/Why-to-choose-you-&-now?</label>
                                            <textarea class="form-control" name="barter_bid" id="barter"></textarea>
                                        </div>

                                    </form>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button id="save_calendar_appointment_btn" class="btn btn-success btn-sm">
                                        Book Appointment
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn-filter" data-bs-toggle="modal" data-bs-target="#calendarPermissionModal">
                        Open Calendar Permissions
                    </button>
                    <div class="modal fade" id="calendarPermissionModal" tabindex="-1" aria-labelledby="calendarPermissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="calendarPermissionModalLabel">Calendar Private/Public Permissions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <!-- Day Wise -->
                                    <div class="mb-4 border-bottom pb-3">
                                        <label class="form-label fw-semibold">Day Wise</label>

                                        <div class="d-flex mb-2">
                                            <input type="date"
                                                name="artificial_day"
                                                id="artificial_day"
                                                class="form-control mb-2"
                                                style="max-width:250px;" />
                                            <select class="form-select ms-3" style="width:200px;" id="day_permission_type">
                                                <option value="viewer">Viewer</option>
                                                <option value="editor">Editor</option>
                                                <option value="comment">Comment</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="small">Make calendar public (day-wise)?</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="toggle_day_public">
                                            </div>
                                            <span id="label_day_public">No</span>
                                        </div>
                                    </div>

                                    <!-- Month Wise -->
                                    <div class="mb-4 border-bottom pb-3">
                                        <label class="form-label fw-semibold">Month Wise</label>

                                        <div class="d-flex mb-2">
                                            <input type="month"
                                                name="artificial_month"
                                                id="artificial_month"
                                                class="form-control mb-2"
                                                style="max-width:250px;" />
                                            <select class="form-select ms-3" style="width:200px;" id="month_permission_type">
                                                <option value="viewer">Viewer</option>
                                                <option value="editor">Editor</option>
                                                <option value="comment">Comment</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="small">Make calendar public (month-wise)?</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="toggle_month_public">
                                            </div>
                                            <span id="label_month_public">No</span>
                                        </div>
                                    </div>

                                    <!-- Year Wise -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Year Wise</label>
                                            <div class="d-flex mb-2">
                                                <input type="number"
                                                name="artificial_year"
                                                id="artificial_year"
                                                class="form-control mb-2"
                                                placeholder="Enter year (e.g. 2026)"
                                                min="1900"
                                                max="2100"
                                                style="max-width:250px;" />
                                            <select class="form-select ms-3" style="width:200px;" id="year_permission_type">
                                                <option value="viewer">Viewer</option>
                                                <option value="editor">Editor</option>
                                                <option value="comment">Comment</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="small">Make calendar public (year-wise)?</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="toggle_year_public">
                                            </div>
                                            <span id="label_year_public">No</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button id="save_calendar_permission_btn" class="btn btn-success btn-sm">
                                        Save Permissions
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn-filter">
                        <a class="me-auto text-light" href="<?= base_url('calendar/data-feeding-panel') ?>" >Data Feeding Panel</a>
                    </button>
                    <button class="btn-filter" id="openSearchFilter">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn-filter" id="btnEnableDisable">Enable/Disable</button>
                    <button class="btn-filter" id="btnPast">Past</button>
                    <button class="btn-filter" id="btnPresent">Present</button>
                    <button class="btn-filter">
                        <a class="text-white" id="" href="<?= base_url('calendar/data-feeding-panel-future') ?>">Future</a>
                    </button>
                    <button class="btn-filter" id="btnWishlist">Wishlist - Future </button>
                </div>
                <button class="btn-filter" id="openPermissionsModal">
                    View Permissions
                </button>
                <div class="modal fade" id="permissionsModal" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Calendar Permissions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div id="permissionsLoader" class="text-center d-none">
                                    Loading...
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm align-middle" style="position:relative !important;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Scope</th>
                                                <th>Date / Month / Year</th>
                                                <th>Permission Type</th>
                                                <th>Public</th>
                                                <th>Created At</th>
                                                <th>Link</th>
                                            </tr>
                                        </thead>
                                        <tbody id="permissionsTableBody">
                                            <tr>
                                                <td colspan="5" class="text-center">No permissions found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <button class="btn-filter">
                    <a class="text-light" href="<?= base_url('company/event-management') ?>">
                        Closed Loop Event Management/Make your own films
                    </a>
                </button>
                <!-- <button class="btn-filter">Population Count</button> -->
                <!-- <div id="calendar"></div> -->

                <!-- Globally Search Function Start  -->
                <div class="globallySearchFilter" id="searchFilterBox">
                    <div class="globallySearchFilterContainer">
                        <div class="searchCloseBtn" id="closeSearchFilter">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <form action="<?= base_url('/calendar-search') ?>" method="get">
                            <div class="form-group">
                                <input type="search" name="calendar-search" placeholder="Searching......"
                                    class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Globally Search Function End -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-between align-items-start">
                <div class="col-3">
                    <div class="d-flex gap-2 justify-content-start">
                        <div class="border border-black">
                            <button class="btn btn-primary w-100 rounded-0 border-bottom border-black">Monthly Count</button>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-around border-bottom border-black">
                                    <span>Bricks: </span>
                                    <span class="" id="monthlyBricks">0</span>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <span>Events: </span>
                                    <span class="" id="monthlyEvents">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="border border-black">
                            <button class="btn btn-primary w-100 rounded-0 border-bottom border-black">Yearly Count</button>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-around border-bottom border-black">
                                    <span>Bricks: </span>
                                    <span class="" id="yearlyBricks">0</span>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <span>Events: </span>
                                    <span class="" id="yearlyEvents">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex flex-column align-self-start gap-3">
                    
                </div>
                <div class="col-3">
                    <button id="monthly_calendar_modal_btn" class="btn btn-primary">Monthly Calendar Download</button>
                </div>

                <div id="monthlyDownloadModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" id="closeMonthlyDownloadModal">&times;</span>
                        <form action="<?= base_url('calendar/download_monthly_event_pdf') ?>" method="POST">

                            <div class="mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="start_date">
                            </div>

                            <div class="mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="end_date">
                            </div>

                            <button type="submit" id="" class="btn btn-primary d-inline">Download</button>
                            
                        </form>
                    </div>
                </div>  
            </div>

            <div class="mt-3" id="calendar"></div>
        </div>
    </div>
</div>



<div id="dayModal" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col-3">
                <h3 id="modalDayName"></h3>
                <h6 id="modalDateName"></h6>
            </div>
            <!-- <div class="col-3">
                <div class="d-flex">
                    <div class="input-box">
                        <label> Opening </label> <br>
                        <input type="time" id="artificialdate" class="time-input">
                    </div>
                    <p class="mt-4 me-3"> -- </p>
                    <div class="input-box">
                        <label> Closing</label><br>
                        <input type="time" id="artificialdate" class="time-input">
                    </div>
                </div>
            </div> -->
            <div class="actionareaViewCase col-9">
                <!-- <div class="d-flex">
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm chatOpen" id="chatOpen"> CHAT </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-dark btn-sm"> TASK</button>
                        <span id="task_count">0</span>
                    </div>
                    <div class="mx-2 d-flex">
                        <button class="btn btn-danger btn-sm me-1"><i class="fas fa-video icon"></i></button>
                        <div class="mt-1"><span id="video_count"></span></div>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-image icon"></i></button>
                        <span id="image_count"></span>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-secondary btn-sm"><i class="fas fa-file-alt icon"></i></button>
                        <span id="file_count"></span>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-dark btn-sm"><i class="fa-solid fa-link"></i></button>
                        <span id="link_count"></span>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-file-audio"></i></button>
                        <span id="audio_count"></span>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-danger btn-sm"> TEXT</button>
                        <span id="text_count"></span>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm">Refresh</button>
                    </div>
                </div> -->
                <div class="mx-2">
                    <button class="btn btn-danger btn-sm">Events</button>
                    <span id="event_count"></span>
                </div>
            </div>
        </div>
        <span class="close-btn" id="closeModal">&times;</span>
        <hr>
        <div class="d-flex justify-content-center align-items-center gap-1">
            <button id="prevYear" class="btn btn-sm bg-light border border-dark"><<<</button>
            <button id="prevMonth" class="btn btn-sm bg-light border border-dark"><<</button>
            <button id="prevDate" class="btn btn-sm bg-light border border-dark"><</button>
            <form class="d-flex mb-0" action="<?= base_url('calendar/data-feeding-panel') ?>" id="timeForm" method="post">
                <!-- <div class="input-box">
                    <label> Opening </label>
                    <input type="time" id="openingTime" id="openingTime" class="time-input" name="openingTime">
                </div>
                <p class="mt-1 mx-3"> -- </p>
                <div class="input-box">
                    <input type="time" id="closingTime" id="closingTime" class="time-input" name="closingTime">
                    <label> Closing</label>
                </div> -->
                <input id="date_input" type="hidden" name="date">
                <div class="mx-2">
                    <button type="submit" class="btn btn-primary btn-sm" href="<?= base_url('calendar/data-feeding-panel') ?>">Data Feeding Panel</button>
                </div>
            </form>
            <button id="nextDate" class="btn btn-sm bg-light border border-dark">></button>
            <button id="nextMonth" class="btn btn-sm bg-light border border-dark">>></button>
            <button id="nextYear" class="btn btn-sm bg-light border border-dark">>>></button>
        </div>
        <hr>

        <div id="timeContainer" class="time-wrapper">
            <!-- <div class="timeandminutesbiffercate"></div>
            <div class="timeandminutesbiffercateright"></div>
            <div class="timeandminutesbiffercatepm"></div>
            <div class="timeandminutesbiffercatepmright"></div>
            <div class="timeandminutesbiffercatepmright2"></div> -->
            <div class="time-label-container">Time</div>
            <div class="toggle-button-container" id="amToggleBtn">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="toggle-button-container-right" id="pmToggleBtn">
                <i class="fa-solid fa-bars"></i>
            </div>

            <ul id="timeListAM" class="time-list am-list"></ul>
            <ul id="timeListPM" class="time-list pm-list"></ul>
        </div>
        <ul id="modalEventList"></ul>
    </div>
</div>



<!-- CHAT MODEL START -->

<div id="chatModal" class="chat-modal">
    <div class="chat-modal-content">
        <span id="chatClose" class="chat-close">&times;</span>
        <h4>Chat Support</h4>
        <form action="<?= base_url('/company/chat/chat_with_user') ?>" id="user_add_to_Portfolio" method="post">
            <div class="row m-md-3">
                <div class="col-md-4">
                    <label for="channelName" class="form-label">Search User</label> <br />
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control" id="team-member-input" name='users-list-tags'
                            placeholder='Search user by name' value='' required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Add to Our
                            Portpolio</button>
                    </div>
                </div>
            </div>
        </form>


        <style>
            .chatModuleUserList {
                height: 660px;
                overflow-y: scroll;
            }

            .rows {
                align-items: flex-start !important;
            }

            .theme_chat_module_handler {
                height: 600px;
                position: relative;
            }

            #userSingleUserMessagesArea {
                border: 1px solid #dadadaff;
                padding: 5px;
                border-radius: 10px;
            }

            .theme_chat_body_container {
                width: 100%;
                padding: 20px;
                height: 550px;
                overflow-y: scroll;
            }

            .theme_chat_body_container .messageUniquiId {
                padding: 5px 10px;
                border-radius: 10px;
                font-size: 14px;
                margin-bottom: 10px !important;
            }

            .theme_chat_body_container .UserMessageSender {
                background-color: #b5faffff;
            }

            .theme_chat_body_container .UserMessageReceiver {
                background-color: #f4f3f3ff;
            }

            .UserMessageReceiver {
                float: right;
            }

            .chatmoduleinputsend {
                display: flex;
            }

            .chatmoduleinputsend input {
                width: 90%;
                border: none;
                outline: none;
                border: 1px solid #e9e9e9;
                border-radius: 10px 0px 0px 10px !important;
            }

            .chatmoduleinputsend button {
                width: 10%;
                border: none;
                outline: none;
                border-radius: 0px 10px 10px 0px !important;

            }
        </style>

        <div class="row rows">
            <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                <!-- ALREADY MESSAGES ON CHAT LIST USER SHOWCASE  -->
                <div class="card border-0 chatModuleUserList" style="width: 100%;">
                    <div class="card-body">
                        <div class="my-3">
                            <button class="btn btn-primary text-white" id="seeAllUsersList">Let's Chat</button>
                        </div>
                        <div class="table-resonsive UserProfileTable" id="userListContainer" style="display:none;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-7">
                <div class="theme_chat_module_handler">
                    <!--SINGLE USER CHAT HERE  -->
                    <div class="theme_chat_header">
                        <div class="row p-0 g-0 m-0">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="team-member-card theme-user-header me-1">
                                    <img src="<?= !empty($user['user_image'])
                                                    ? base_url('uploads/user_profile/' . $user['user_image'])
                                                    : base_url('assets/user-icon.png') ?>" alt="Profile">

                                    <div class="team-member-info">
                                        <h6>
                                            <?= $user['name'] ?: 'No Name' ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="team-member-card theme-user-header">
                                    <img src="<?= !empty($user['user_image'])
                                                    ? base_url('uploads/user_profile/' . $user['user_image'])
                                                    : base_url('assets/user-icon.png') ?>" alt="Profile">

                                    <div class="team-member-info">
                                        <h6>
                                            <?= $user['name'] ?: 'No Name' ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="userSingleUserMessagesArea">
                        <div class="theme_chat_body_container">

                            <!-- SENDER  / Receiver Chats-->
                            <div class="UserMessageSenderReceiver">
                                <span class="messageUniquiId UserMessageSender">Hii</span> <br /> <br />
                                <span class="messageUniquiId UserMessageReceiver">Hello</span><br /> <br />

                                <span class="messageUniquiId UserMessageSender">Abhi Kis Module par work kar rahe
                                    ho?</span> <br /> <br />
                                <span class="messageUniquiId UserMessageReceiver">I'm Currently Working on. Chat Module
                                </span><br /> <br />
                                <span class="messageUniquiId UserMessageReceiver">ab meeting kal karte hai </span><br />
                                <br />
                                <span class="messageUniquiId UserMessageReceiver"> Okay? </span><br /> <br />
                                <span class="messageUniquiId UserMessageSender">Okay</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Done</span> <br /> <br />
                                <span class="messageUniquiId UserMessageReceiver">Thank You !</span><br /> <br />
                                <span class="messageUniquiId UserMessageSender">Welcome</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Work Complete Hua?</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Hello</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Kaha Gaye?</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Meeting Kare?</span> <br /> <br />
                                <span class="messageUniquiId UserMessageSender">Yes, Plz Join</span> <br /> <br />
                                <span class="messageUniquiId UserMessageReceiver">Yes Joining </span><br /> <br />

                            </div>
                        </div>
                        <div class="theme-module-chat-input">
                            <div class="form-group chatmoduleinputsend">
                                <input type="text" class="form-control" name="chatsender" placeholder="Type here...">
                                <button type="submit" class="btn-light btn"> Send </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<!-- CHAT MODEL END -->

<div id="timeStampModal" class="modal calendar-modal" data-schedule="fixed">
    <div class="modal-content">
        <span id="closeTimeStamp" class="close">&times;</span>
        <h2>Select Time</h2>
        <p><strong>Opening:</strong> <span id="showOpening"></span></p>
        <p><strong>Closing:</strong> <span id="showClosing"></span></p>
        <div class="bodycontentforModel">
            <div class="actionareaViewCase">
                <div class="d-flex">
                    <div class="mx-2">
                        <select class="form-select text-white" name="whatyou" id="project_component"
                            style="height:30px; width:160px; margin-right: 10px; background-color: #4772f3;">
                            <option value="">Select</option>
                            <option value="task">Task</option>
                            <option value="milestone">Milestone</option>
                            <option value="strategie">Strategie</option>
                            <option value="scene">Scene</option>
                            <option value="updates">Updates</option>
                            <option value="events">Events</option>
                        </select>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-danger btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/gettextdata') ?>"
                                data-target="#textDataContainer"
                                data-type="text"
                                data-box="#box_textbox">
                            TEXT
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-warning btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/getImagesdata') ?>"
                                data-type="image"
                                data-target="#textDataContainer2"
                                data-box="#box_imagebox">
                            <i class="fas fa-image"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-secondary btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/getDocsdata') ?>"
                                data-type="docs"
                                data-target="#textDataContainer3"
                                data-box="#box_DocsBox">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>
                    <div class="mx-2 d-flex">
                        <button class="btn btn-danger btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/getVideodata') ?>"
                                data-type="video"
                                data-target="#textDataContainer4"
                                data-box="#box_videobox">
                            <i class="fas fa-video"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-dark btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/getAudiodata') ?>"
                                data-type="audio"
                                data-target="#textDataContainer5"
                                data-box="#box_audiobox">
                            <i class="bi bi-mic-fill"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-dark btn-sm tab-btn fetch-btn"
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="other"
                                data-target="#textDataContainer6"
                                data-box="#box_otherlinksbox">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm" id="refreshTab">Refresh</button>
                    </div>
                </div>


                <div class="content_adding__container mt-4">
                    <div class="box_textbox borderBoxesAreaContainer tab-box" id="box_textbox">
                        <h6> TEXT BOX</h6>
                        <textarea class="form-control" name="textbox" id="textbox"
                            placeholder="Enter Your Description"></textarea>
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="text"
                                    data-url="<?= base_url('Calendar/saveTextbox') ?>">
                                Update
                            </button>
                        </div>

                        <div id="textDataContainer" style="overflow-y:scroll;"></div>

                    </div>

                    <div class="box_videobox borderBoxesAreaContainer tab-box" id="box_videobox">
                        <h6> VIDEO <span style="font-size:12px; float:right; color:red"> only "mp4|mov|avi|mkv|webm"
                                format allowed </span></h6>
                        <input type="file" class="form-control" name="video" id="video" accept="video/*">
                        <input type="text" class="form-control mt-2" name="videolink" placeholder="Paste link"
                            id="videolink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="video"
                                    data-url="<?= base_url('Calendar/saveVideo') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer4" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_audiobox borderBoxesAreaContainer tab-box" id="box_audiobox">
                        <h6> AUDIO <span style="font-size:12px; float:right; color:red"> only "mp3|mav|aac|m4a|ogg"
                                format allowed </span></h6>
                        <input type="file" class="form-control" name="audio" id="audio">
                        <input type="text" class="form-control mt-2" name="audiolink" placeholder="Paste link"
                            accept="audio/*" id="audiolink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="audio"
                                    data-url="<?= base_url('Calendar/saveAudio') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer5" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_imagebox borderBoxesAreaContainer tab-box" id="box_imagebox">
                        <h6> IMAGE <span style="font-size:12px; float:right; color:red"> only "jpg/jpeg/png/webp" format
                                allowed </span> </h6>
                        <input type="file" class="form-control" name="image" id="image" style="z-index:999;">
                        <input type="text" class="form-control mt-2" name="imagelink" placeholder="Paste link"
                            id="imagelink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="image"
                                    data-url="<?= base_url('Calendar/saveImage') ?>">
                                Update
                            </button>

                        </div>
                        <div id="textDataContainer2" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_DocsBox borderBoxesAreaContainer tab-box" id="box_DocsBox">
                        <h6> DOCUMENTS <span style="font-size:12px; float:right; color:red"> only
                                "pdf|html|avi|mkv|webm" format allowed </span> </h6>
                        <input type="file" class="form-control" name="docs" id="docs">
                        <input type="text" class="form-control mt-2" name="docslink" placeholder="Paste link"
                            id="docslink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="docs"
                                    data-url="<?= base_url('Calendar/saveDocsLink') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer3" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_otherlinksbox borderBoxesAreaContainer tab-box" id="box_otherlinksbox">
                        <h6> LINKS </h6>
                        <input type="text" class="form-control" name="otherlink" placeholder="Paste link"
                            id="otherlink">
                        <div class="d-flex">
                            <input type="text" class="form-control my-2" name="time" placeholder="Time" id="time">
                            <select class="form-select my-2" id="timeslot" name="timeslot">
                                <option value="min"> Min</option>
                                <option value="hour"> Hours</option>
                            </select>
                        </div>
                        <select class="form-select" name="linkcategory" id="linkcategory">
                            <option value="" disabled> Select Category </option>
                            <option value="Videos"> Videos </option>
                            <option value="Images"> Images </option>
                            <option value="Docs"> Docs </option>
                            <option value="Audios"> Audios </option>
                            <option value="Websites"> Websites </option>
                            <option value="Others"> Others </option>
                        </select>

                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="other"
                                    data-url="<?= base_url('Calendar/saveCategory') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer6" style=" overflow-y:scroll;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dataFeedingModal" class="modal calendar-modal" data-schedule="fixed">
    <div class="modal-content">
        <span id="closeDataFeedingModal" class="close">&times;</span>
        <!-- <h2>Select Time</h2> -->
        
    </div>
</div>


<!-- Custom Modal -->
<div id="enableDisableModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <span id="enabledisabletitle">Enable Disable Model</span>
        </div>
        <div class="modal-body">
            <div id="questionBox1" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class="align-items-center">
                    <label class="me-2"> Press Release/Media Updates </label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                    </div>
                </div>
            </div>
            <div id="questionBox2" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class=" align-items-center">
                    <label class="me-2"> Personal/Professional Bricks </label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="personalprofessionalbricks" data-index="2"
                                name="personalprofessionalbricks" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="2">Yes</span> <br />
                    </div>
                </div>
            </div>
            <div id="questionBox3" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class="align-items-center">
                    <label class="me-2"> Photos / Videos </label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="photosvideos" data-index="3" name="photosvideos" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="3">Yes</span> <br />
                    </div>
                </div>
            </div>
            <div id="questionBox4" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class="align-items-center">
                    <label class="me-2"> Timeline </label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="photosvideos" data-index="4" name="timeline" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="4">Yes</span> <br />
                    </div>
                </div>
            </div>

            <div id="questionBox5" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class="align-items-center">
                    <label class="me-2"> Series & Parralal Events </label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="seriesparralalevents" data-index="5"
                                name="seriesparralalevents" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="5">Yes</span> <br />
                    </div>
                </div>
            </div>
            <div id="questionBox6" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                <div class="align-items-center">
                    <label class="me-2"> Reverse Timer <> Forward Timer</label>
                    <div style="float:right; margin-right:20px;">
                        <label class="switch me-2">
                            <input type="checkbox" class="reverse_timer" data-index="6" name="reverse_timer" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="6">Yes</span> <br />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="closeBtnEnableDisable" onclick="closeModalEnableDisable()" class="btn-close">Close</button>
        </div>
    </div>
</div>

<!-- Future Modal -->
<div id="futureTaskModal" class="modal calendar-modal" data-schedule="future">
    <div class="modal-content align-items-start">
        <span id="closeTimeStampFuture" class="close">&times;</span>
        <h5>Celebrity Management - Future</h5>
        <div class="bodycontentforModel">
            <div class="actionareaViewCase">
                <div class="d-flex">
                    <div class="mx-2">
                        <select class="form-select text-white" name="whatyou" id="project_component"
                            style="height:30px; width:160px; margin-right: 10px; background-color: #4772f3;">
                            <option value="">Select</option>
                            <option value="task">Task</option>
                            <option value="milestone">Milestone</option>
                            <option value="strategie">Strategie</option>
                            <option value="scene">Scene</option>
                            <option value="updates">Updates</option>
                            <option value="events">Events</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;"
                                data-url="<?= base_url('Calendar/gettextdata') ?>"
                                data-type="text"
                                data-target="#textDataContainer"
                                data-box="#box_textbox">
                            THOUGHTS
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;"
                                data-url="<?= base_url('Calendar/gettextdata') ?>"
                                data-type="text"
                                data-target="#textDataContainer"
                                data-box="#box_textbox">
                            TEXT
                        </button>
                    </div>
                    <div class="mx-2">
                        <a href="<?= base_url('company/create-brick') ?>"  class="btn btn-primary btn-sm"
                                style="background-color: #04d6e5ff !important;"
                                data-url="<?= base_url('Calendar/gettextdata') ?>"
                                data-type="text"
                                data-target="#textDataContainer"
                                data-box="#box_textbox">
                            BRICK PAY
                        </a>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;
                                    padding: 6px 8px !important;
                                "
                                data-url="<?= base_url('Calendar/getImagesdata') ?>"
                                data-type="image"
                                data-target="#textDataContainer2"
                                data-box="#box_imagebox">
                            <i class="fas fa-image m-0"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;
                                    padding: 6px 8px !important;
                                "
                                data-url="<?= base_url('Calendar/getDocsdata') ?>"
                                data-type="docs"
                                data-target="#textDataContainer3"
                                data-box="#box_DocsBox">
                            <i class="fas fa-file-alt m-0"></i>
                        </button>
                    </div>
                    <div class="mx-2 d-flex">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;
                                    padding: 6px 8px !important;
                                "
                                data-url="<?= base_url('Calendar/getVideodata') ?>"
                                data-type="video"
                                data-target="#textDataContainer4"
                                data-box="#box_videobox">
                            <i class="fas fa-video m-0"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;
                                    padding: 6px 8px !important;
                                "
                                data-url="<?= base_url('Calendar/getAudiodata') ?>"
                                data-type="audio"
                                data-target="#textDataContainer5"
                                data-box="#box_audiobox">
                            <i class="bi bi-mic-fill m-0"></i>
                        </button>
                    </div>

                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm tab-btn fetch-btn"
                                style="background-color: #04d6e5ff !important;
                                    padding: 6px 8px !important;
                                "
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="other"
                                data-target="#textDataContainer6"
                                data-box="#box_otherlinksbox">
                            <i class="fa-solid fa-link m-0"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary btn-sm"
                        style="background-color: #04d6e5ff !important;"
                        id="refreshTab">Refresh</button>
                    </div>
                </div>


                <div id="borderBoxesInputAreaContainer" class="content_adding__container mt-4">
                    <div class="box_textbox borderBoxesAreaContainer tab-box" id="box_textbox">
                        <h6> TEXT BOX</h6>
                        <textarea class="form-control" name="textbox" id="textbox"
                            placeholder="Enter Your Description"></textarea>
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="text"
                                    data-url="<?= base_url('Calendar/saveTextbox') ?>">
                                Update
                            </button>
                        </div>

                        <div id="textDataContainer" style="overflow-y:scroll;"></div>

                    </div>

                    <div class="box_videobox borderBoxesAreaContainer tab-box" id="box_videobox">
                        <h6> VIDEO <span style="font-size:12px; float:right; color:red"> only "mp4|mov|avi|mkv|webm"
                                format allowed </span></h6>
                        <input type="file" class="form-control" name="video" id="video" accept="video/*">
                        <input type="text" class="form-control mt-2" name="videolink" placeholder="Paste link"
                            id="videolink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="video"
                                    data-url="<?= base_url('Calendar/saveVideo') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer4" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_audiobox borderBoxesAreaContainer tab-box" id="box_audiobox">
                        <h6> AUDIO <span style="font-size:12px; float:right; color:red"> only "mp3|mav|aac|m4a|ogg"
                                format allowed </span></h6>
                        <input type="file" class="form-control" name="audio" id="audio">
                        <input type="text" class="form-control mt-2" name="audiolink" placeholder="Paste link"
                            accept="audio/*" id="audiolink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="audio"
                                    data-url="<?= base_url('Calendar/saveAudio') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer5" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_imagebox borderBoxesAreaContainer tab-box" id="box_imagebox">
                        <h6> IMAGE <span style="font-size:12px; float:right; color:red"> only "jpg/jpeg/png/webp" format
                                allowed </span> </h6>
                        <input type="file" class="form-control" name="image" id="image" style="z-index:999;">
                        <input type="text" class="form-control mt-2" name="imagelink" placeholder="Paste link"
                            id="imagelink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="image"
                                    data-url="<?= base_url('Calendar/saveImage') ?>">
                                Update
                            </button>

                        </div>
                        <div id="textDataContainer2" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_DocsBox borderBoxesAreaContainer tab-box" id="box_DocsBox">
                        <h6> DOCUMENTS <span style="font-size:12px; float:right; color:red"> only
                                "pdf|html|avi|mkv|webm" format allowed </span> </h6>
                        <input type="file" class="form-control" name="docs" id="docs">
                        <input type="text" class="form-control mt-2" name="docslink" placeholder="Paste link"
                            id="docslink">
                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="docs"
                                    data-url="<?= base_url('Calendar/saveDocsLink') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer3" style="overflow-y:scroll;"></div>
                    </div>

                    <div class="box_otherlinksbox borderBoxesAreaContainer tab-box" id="box_otherlinksbox">
                        <h6> LINKS </h6>
                        <input type="text" class="form-control" name="otherlink" placeholder="Paste link"
                            id="otherlink">
                        <div class="d-flex">
                            <input type="text" class="form-control my-2" name="time" placeholder="Time" id="time">
                            <select class="form-select my-2" id="timeslot" name="timeslot">
                                <option value="min"> Min</option>
                                <option value="hour"> Hours</option>
                            </select>
                        </div>
                        <select class="form-select" name="linkcategory" id="linkcategory">
                            <option value="" disabled> Select Category </option>
                            <option value="Videos"> Videos </option>
                            <option value="Images"> Images </option>
                            <option value="Docs"> Docs </option>
                            <option value="Audios"> Audios </option>
                            <option value="Websites"> Websites </option>
                            <option value="Others"> Others </option>
                        </select>

                        <div class="mx-2 text-center mt-5">
                            <button class="btn btn-dark btn-sm save-btn"
                                    data-type="other"
                                    data-url="<?= base_url('Calendar/saveCategory') ?>">
                                Update
                            </button>
                        </div>
                        <div id="textDataContainer6" style="overflow-y:scroll;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Future Modal -->
<div id="editTaskModal" class="modal calendar-modal" data-schedule="">
    <div class="modal-content justify-content-center align-items-center">
        <span id="closeEditTaskModal" class="close">&times;</span>
        <h4 class="mb-3">Edit Task</h4>

    <div class="editTaskContainer">

      <!-- ================= TEXT ================= -->
      <div class="edit-section" data-edit-type="text">
        <label class="fw-semibold">Text</label>
        <textarea
          id="edit_textbox"
          class="form-control"
          rows="4"
          placeholder="Edit text"
        ></textarea>
      </div>

      <!-- ================= IMAGE ================= -->
      <div class="edit-section" data-edit-type="image">
        <label class="fw-semibold">Image Link</label>
        <input
          type="text"
          id="edit_imagelink"
          class="form-control"
          placeholder="Image URL"
        >
      </div>

      <!-- ================= VIDEO ================= -->
      <div class="edit-section" data-edit-type="video">
        <label class="fw-semibold">Video Link</label>
        <input
          type="text"
          id="edit_videolink"
          class="form-control"
          placeholder="Video URL"
        >
      </div>

      <!-- ================= AUDIO ================= -->
      <div class="edit-section" data-edit-type="audio">
        <label class="fw-semibold">Audio Link</label>
        <input
          type="text"
          id="edit_audiolink"
          class="form-control"
          placeholder="Audio URL"
        >
      </div>

      <!-- ================= DOCS ================= -->
      <div class="edit-section" data-edit-type="docs">
        <label class="fw-semibold">Document Link</label>
        <input
          type="text"
          id="edit_docslink"
          class="form-control"
          placeholder="Document URL"
        >
      </div>

      <!-- ================= ACTION ================= -->
      <div class="mt-3 text-end">
        <button id="updateTaskBtn" class="btn btn-primary btn-sm">
          Update Task
        </button>
      </div>
    </div>
    </div>
</div>


<script>
    let EVENTS = [];
    let TIMELINES = [];
    let RES = [];
    document.addEventListener("DOMContentLoaded", function () {

        const closeBtn = document.getElementById("closeBtn");
        const previewIcon = document.getElementById("previewIcon");

        // === MAIN CALENDAR ===
        const calendarEl = document.getElementById("calendar");
        
        const mainCalendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear',
                center: 'title',
                right: ''
            },
            views: {
                year: {
                    type: 'dayGrid',
                    duration: {
                        years: 1
                    },
                    buttonText: 'Year'
                }
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'Schedule',
                year: 'Year'
            },



            dayCellDidMount: function (info) {

                info.el.addEventListener("click", function () {
                    const clickedDate = info.date;
                    // console.log("clickedDate",clickedDate)
                    // Convert to local date before ISO
                    renderCalendarModal(clickedDate)
                });
            },

            eventSources: [{
                    url: '<?= site_url("calendar/events"); ?>',
                    method: "GET"
                },
                {
                    url: '<?= site_url("calendar/press_release_events"); ?>',
                    method: "GET"
                },
            ],
            
            datesSet: function(info) {
                try {
                    
                    // 🔹 1) Render day-wise badges for visible range
                    loadEventCounts(info.startStr, info.endStr);

                    // 🔹 Monthly count = visible month range
                    loadCountsForRange(info.startStr, info.endStr, 'monthly');

                    // 🔹 Yearly count = full year of the current view date
                    const viewDate = mainCalendar.getDate();  // 👈 this is key
                    const year = viewDate.getFullYear();

                    const yearStart = `${year}-01-01`;
                    const yearEnd   = `${year}-12-31`;

                    loadCountsForRange(yearStart, yearEnd, 'yearly');

                } catch (e) {
                    console.error('datesSet error:', e);
                }
            },


            editable: false,
            selectable: false

        });

        function loadEventCounts(start, end) {
            $.ajax({
                url: '<?= site_url("calendar/events_count"); ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    start: start,
                    end: end
                },
                success: function (res) {
                    if (res && res.success) {
                        renderCountBadges(res.data);
                    }
                },
                error: function (xhr) {
                    console.error('events_count failed', xhr);
                }
            });
        }

        function renderCountBadges(data) {
            const map = {};
            data.forEach(row => {
                map[row.date] = parseInt(row.total_events, 10);
            });

            document.querySelectorAll('.event-count-badge').forEach(b => b.remove());

            document.querySelectorAll('.fc-daygrid-day').forEach(dayEl => {
                const date = dayEl.getAttribute('data-date');
                const count = map[date] || 0;

                if (count > 0) {
                    const badge = document.createElement('span');
                    badge.className = 'event-count-badge';
                    badge.textContent = `events: ${count}`;

                    const top = dayEl.querySelector('.fc-daygrid-day-top');
                    if (top) top.appendChild(badge);
                }
            });
        }

        function loadCountsForRange(start, end, mode) {
            // EVENTS
            $.getJSON('<?= site_url("calendar/events_count"); ?>', { start, end })
            .done(res => {
                if (res.success) updateEventsUI(res.data, mode);
            });

            // BRICKS
            $.getJSON('<?= site_url("calendar/bricks_count"); ?>', { start, end })
            .done(res => {
                if (res.success) updateBricksUI(res.data, mode);
            });
        }

        let totalEvents = 0;
        let totalBricks = 0;

        function updateEventsUI(rows, mode) {
            let total = 0;
            rows.forEach(r => total += parseInt(r.total_events, 10) || 0);

            if (mode === 'monthly') $('#monthlyEvents').text(total);
            if (mode === 'yearly')  $('#yearlyEvents').text(total);
        }

        function updateBricksUI(rows, mode) {
            let total = 0;
            rows.forEach(r => total += parseInt(r.total_bricks, 10) || 0);

            if (mode === 'monthly') $('#monthlyBricks').text(total);
            if (mode === 'yearly')  $('#yearlyBricks').text(total);
        }

        function animateCount($el, to) {
            const from = parseInt($el.text(), 10) || 0;
            $({ val: from }).animate({ val: to }, {
                duration: 300,
                step: function(now) {
                $el.text(Math.floor(now));
                },
                complete: function() {
                $el.text(to);
                }
            });
        }

        animateCount($('#monthlyEvents'), totalEvents);

        mainCalendar.render();

        function renderCalendarModal(clickedDate){
            const localDate = new Date(clickedDate.getTime() - clickedDate.getTimezoneOffset() * 60000);
            const dateStr = localDate.toISOString().split("T")[0];

            // Set Day Name & Full Date
            document.getElementById("modalDayName").innerHTML =
                clickedDate.toLocaleDateString("en-US", {
                    weekday: "long"
                });

            document.getElementById("modalDateName").innerHTML =
                clickedDate.toLocaleDateString("en-US", {
                    day: "numeric",
                    month: "long",
                    year: "numeric"
                });

            const times = getTimeSlots(); // 12:00 AM ... 11:00 PM

            let amHTML = "";
            let pmHTML = "";

            times.forEach(t => {
                const isPM = t.includes("PM");
                const html = `
                        <li data-time="${convertTo24(t)}" class="timingshowcase_date row p-0 m-0 border-0">
                            <span class="col-md-1 h-100" style="place-content: center; background: #e3e3e3">${t}</span>
                            <span class="minutes_showcase_area col-md-2" style="border-inline: 1px solid black" id="minutes_showcase_area"></span>
                            <span class="minutes_showcase_area_content col-md-9 p-0" id="minutes_showcase_area_content"></span>
                        </li>
                    `;
                if (isPM) {
                    pmHTML += html;
                } else {
                    amHTML += html;
                }
            });

            document.getElementById("timeListAM").innerHTML = amHTML;
            document.getElementById("timeListPM").innerHTML = pmHTML;

            document.querySelectorAll(".minutes_showcase_area").forEach(container => {
                for (let i = 0; i < 60; i++) {
                    const line = document.createElement("span");
                    // line.textContent = i;
                    if (i == 59) {
                        line.className = "last-line";
                    } else {
                        line.className = "minute-line";
                        const inner_line = document.createElement("span");
                        line.appendChild(inner_line);
                    }
                    container.appendChild(line);
                }
            });

            // Toggle AM Section
            // document.getElementById("pmToggleBtn").addEventListener("click", function () {
            //     document.querySelectorAll(".minutes_showcase_area").forEach(el => {
            //         el.classList.toggle("active");
            //     });
            //     if ($('.timingshowcase_date').height() == 300) {

            //         $('.timingshowcase_date').height(100);
            //         $('.minutes_showcase_area span span').css('display', 'none');
            //     } else {
            //         $('.timingshowcase_date').height(300);
            //         $('.minutes_showcase_area span span').css('display', 'block');
            //     }
            // });

            // document.getElementById("amToggleBtn").addEventListener("click", function () {
            //     console.log('amToggleBtn clicked')
            //     document.querySelectorAll(".minutes_showcase_area").forEach(el => {
            //         el.classList.toggle("active");
            //     });
            //     if ($('.timingshowcase_date').height() == 300) {
            //         $('.timingshowcase_date').height(100);
            //     } else {
            //         $('.timingshowcase_date').height(300);
            //     }
            // });

            let isMinutesOpen = false;  // current state

            function toggleMinutes() {
                isMinutesOpen = !isMinutesOpen;  // flip state

                const container = $('.timingshowcase_date');

                container.stop().animate({ height: isMinutesOpen ? 300 : 100 }, 200, function (){
                    renderAllEvents(RES)
                });

                $('.minutes_showcase_area')
                    .toggleClass('active', isMinutesOpen)
                    .find('span span')
                    .toggle(isMinutesOpen);
                
            }
            
            $('#pmToggleBtn, #amToggleBtn').on('click', function () {
                toggleMinutes();
            });


            document.querySelectorAll(".minutes_showcase_area_content").forEach(container => {
                for (let i = 0; i < 9; i++) {
                    const line = document.createElement("span");
                    line.className = "section_saprate";
                    container.appendChild(line);
                }
            });

            // 🔥 Get Events of Selected Day
            const eventsOfDay = mainCalendar.getEvents().filter(ev => {
                return ev.startStr.startsWith(dateStr);
            });

            let html = "";
            if (eventsOfDay.length === 0) {
                html = `<li>No events today.</li>`;
            } else {
                eventsOfDay.forEach(ev => {
                    html += `
                        <li class="eventItem">
                            <strong>${ev.title || ev.extendedProps.uniq_id || "No Title"}</strong>
                            <br>
                            <span>${new Date(ev.start).toLocaleTimeString([], {
                        hour: "2-digit",
                        minute: "2-digit"
                    })}</span>
                            <a href="#" class="viewEvent"
                            data-id="${ev.id}" 
                            data-type="${ev.extendedProps.type}">
                            👁️
                            </a>
                        </li>
                    `;
                });
            }
            document.getElementById("modalEventList").innerHTML = html;

            // Show Modal
            document.getElementById("dayModal").style.display = "block";

            // DYANACMIC DATA FATCH ON CALENDAR WITH DATA AND TIME 
            $.ajax({
                url: "<?= base_url("Calendar/getCalendarTimelineMaster") ?>",
                type: "POST",
                dataType: "json",
                data: {
                    dateStr
                },
                success: function (res) {
                    // EVENTS = res.events;
                    TIMELINES = res.timelines;
                    RES = res;
                    // console.log(res);
                    // return;
                    renderAllEvents(RES, dateStr);

                    // console.log(eventColumnMap);
                    // console.log(columns);


                    // let counts = {
                    //     textbox: 0,
                    //     video: 0,
                    //     audio: 0,
                    //     image: 0,
                    //     docs: 0,
                    //     otherlink: 0
                    // };

                    // res.timelines.forEach(event => {
                    //     if (counts[event.type] !== undefined) {
                    //         counts[event.type]++;
                    //     }
                    // });

                    // update UI
                    // $('#task_count').text(eventsOfDay.length);
                    // $('#text_count').text(counts.textbox);
                    // $('#video_count').text(counts.video);
                    // $('#image_count').text(counts.image);
                    // $('#file_count').text(counts.docs);
                    // $('#audio_count').text(counts.audio);
                    // $('#link_count').text(counts.otherlink);
                    $('#event_count').text(res.timelines.length);


                }
            });
        }
        
        function renderAllEvents(res, dateStr){
            const eventColumnMap = new Map();
            let columns = [];
            
            $("#timeListAM li, #timeListPM li").each(function () {

                let slotTime = $(this).data("time");
                let dateCheck = dateStr; // YYYY-MM-DD
                let slotHour = slotTime.split(':')[0];

                // console.log("slotTime", slotTime);
                // console.log("slotHour", slotHour);
                // console.log("slotHourType", typeof(slotHour));

                // 🔴 CLEAR OLD EVENTS
                $(this).find(".event-item").remove();

                // 🔵 POSITION MANAGEMENT
                let baseLeft = 0;
                // let increment = 9;
                let leftCount = 0;
                let height = 0;
                let topOffset = -8;
                let bottomOffset = 0;
                // let columns = [];
                // console.log(eventColumnMap);
                // console.log(columns);

                res.timelines.forEach(item => {
                    console.log("item",item)
                    const startMin = toMinutes(item.opening_time);
                    const endMin = toMinutes(item.closing_time, true);

                    const slotStartMin = toMinutes(slotTime);
                    const slotEndMin = slotStartMin + 60;

                    // overlap check
                    if (!(startMin < slotEndMin && endMin > slotStartMin)) return;

                    // height math
                    // const rowHeight = 300;
                    const minutesArea = $(this).find('.minutes_showcase_area_content');

                    const rowHeight = minutesArea.parent().height(); 

                    const oneMinHeight = rowHeight / 60;

                    const visibleStart = Math.max(startMin, slotStartMin);
                    const visibleEnd = Math.min(endMin, slotEndMin);

                    const topOffset = (visibleStart - slotStartMin) * oneMinHeight - 4;
                    const height = (visibleEnd - visibleStart) * oneMinHeight;
                    // console.log('item.id', item.data.id);

                    const colIndex = getStableColumnIndex(item.id, startMin, endMin, columns, eventColumnMap);

                    if (colIndex === null) {
                        console.warn('Timeline full, skipping event:', item.id);
                        return;
                    }

                    // const minutesArea = $(this).find('.minutes_showcase_area_content');

                    const col9width = minutesArea.outerWidth();
                    let col1width = col9width / 9;

                    const leftPos = col1width * colIndex;
                    const width = col1width;

                    minutesArea.append(renderEvent({
                        // ...getEventRenderConfig(item),
                        bg: "#b7d7ff",
                        border: "#1a73e8",
                        time: `${item.opening_time} - ${item.closing_time}`,
                        top: topOffset,
                        height,
                        left: leftPos,
                        width: width,
                        timeline_id: item.id,
                        text: 'event'
                    }));
                });
                
                res.bricks.forEach(item => {
                    console.log("item",item)
                    const opening_time = item.create_date.split(' ')[1]
                    const startMin = toMinutes(opening_time);
                    const closing_time = addMinutesToTime(opening_time);
                    const endMin = toMinutes(closing_time, true);

                    const slotStartMin = toMinutes(slotTime);
                    const slotEndMin = slotStartMin + 60;

                    // overlap check
                    if (!(startMin < slotEndMin && endMin > slotStartMin)) return;

                    // height math
                    // const rowHeight = 300;
                    const minutesArea = $(this).find('.minutes_showcase_area_content');

                    const rowHeight = minutesArea.parent().height(); 
                    const oneMinHeight = rowHeight / 60;

                    const visibleStart = Math.max(startMin, slotStartMin);
                    const visibleEnd = Math.min(endMin, slotEndMin);

                    const topOffset = (visibleStart - slotStartMin) * oneMinHeight - 4;
                    const height = (visibleEnd - visibleStart) * oneMinHeight;
                    // console.log('item.id', item.data.id);

                    const colIndex = getStableColumnIndex(item.id, startMin, endMin, columns, eventColumnMap);

                    if (colIndex === null) {
                        console.warn('Timeline full, skipping event:', item.id);
                        return;
                    }

                    // const minutesArea = $(this).find('.minutes_showcase_area_content');

                    const col9width = minutesArea.outerWidth();
                    let col1width = col9width / 9;

                    const leftPos = col1width * colIndex;;
                    const width = col1width;

                    minutesArea.append(renderEvent({
                        // ...getEventRenderConfig(item),
                        bg: "#b7d7ff",
                        border: "#1a73e8",
                        time: `${opening_time} - ${closing_time}`,
                        top: topOffset,
                        height,
                        left: leftPos,
                        width: width,
                        timeline_id: item.id,
                        text: 'brick'
                    }));
                });
                
                res.appointments.forEach(item => {
                    console.log("item",item)
                    const opening_time = item.start_datetime.split(' ')[1];
                    const closing_time = item.end_datetime.split(' ')[1];
                    const startMin = toMinutes(opening_time);
                    const endMin = toMinutes(closing_time, true);
                    // console.log("startMin",startMin)
                    // console.log("endMin",endMin)
                    const slotStartMin = toMinutes(slotTime);
                    const slotEndMin = slotStartMin + 60;

                    // overlap check
                    if (!(startMin < slotEndMin && endMin > slotStartMin)) return;

                    // height math
                    const minutesArea = $(this).find('.minutes_showcase_area_content');

                    const rowHeight = minutesArea.parent().height();
                    
                    const oneMinHeight = rowHeight / 60;

                    const visibleStart = Math.max(startMin, slotStartMin);
                    const visibleEnd = Math.min(endMin, slotEndMin);

                    const topOffset = (visibleStart - slotStartMin) * oneMinHeight - 4;
                    const height = (visibleEnd - visibleStart) * oneMinHeight;
                    // console.log('item.id', item.data.id);

                    const colIndex = getStableColumnIndex(item.id, startMin, endMin, columns, eventColumnMap);

                    if (colIndex === null) {
                        console.warn('Timeline full, skipping event:', item.id);
                        return;
                    }

                    // const minutesArea = $(this).find('.minutes_showcase_area_content');
                    
                    const col9width = minutesArea.outerWidth();
                    let col1width = col9width / 9;

                    const leftPos = col1width * colIndex;
                    const width = col1width;

                    minutesArea.append(renderEvent({
                        // ...getEventRenderConfig(item),
                        bg: "#b7d7ff",
                        border: "#1a73e8",
                        time: `${opening_time} - ${closing_time}`,
                        top: topOffset,
                        height,
                        left: leftPos,
                        width: width,
                        timeline_id: item.id,
                        text: `appointment (${item.status})`
                    }));
                });
            });
        }
        
        function getEventRenderConfig(item) {
            switch (item.type) {

                case 'textbox':
                    return {
                        bg: "#b7d7ff",
                        border: "#1a73e8",
                        icon: `<img src="<?= base_url('/assets/images/text-icon.jpeg') ?>" style="height:15px;width:15px; z-index: 1; position: relative;" />`
                    };

                case 'video':
                    return {
                        bg: "#ffe5b7",
                        border: "#ff9800",
                        icon: `<a style="z-index: 1; position: relative;" href="<?= base_url('/uploads/calendar_video/') ?>${item.video}?play=1" target="_blank">🎬</a>`,
                        title: `<a href="<?= base_url('/uploads/calendar_video/') ?>${item.video}?play=1" target="_blank">🎬</a>`
                    };

                case 'audio':
                    return {
                        bg: "#05c5ff53",
                        border: "#05c5ffff",
                        icon: `<a style="z-index: 1; position: relative;" href="<?= base_url('/uploads/calendar_audio/') ?>${item.audio}" target="_blank">🎤</a>`,
                        title: `<a href="<?= base_url('/uploads/calendar_audio/') ?>${item.audio}" target="_blank">🎤</a>`
                    };

                case 'image':
                    return {
                        bg: "#ffa20033",
                        border: "#ffa200ff",
                        icon: `<a style="z-index: 1; position: relative;" href="<?= base_url('/uploads/calendar_image/') ?>${item.image}" target="_blank">
                                <img src="<?= base_url('/uploads/calendar_image/') ?>${item.image}" style="height:20px;width:20px;" />
                            </a>`
                    };

                case 'docs':
                    return {
                        bg: "#d300ef29",
                        border: "#d300efff",
                        icon: `<a style="z-index: 1; position: relative;" href="<?= base_url('/uploads/calendar_docs/') ?>${item.docs}" target="_blank">📄</a>`,
                        title: `<a href="<?= base_url('/uploads/calendar_docs/') ?>${item.docs}" target="_blank">📄</a>`
                    };

                case 'otherlink':
                    return {
                        bg: "#0014ef36",
                        border: "#0014efff",
                        icon: `<a style="z-index: 1; position: relative;" href="${item.otherlink}" target="_blank">
                                🔗 - ${item.linkcategory}
                            </a>`,
                        title: `<a href="${item.otherlink}" target="_blank">
                                🔗 - ${item.linkcategory}
                            </a>`
                    };

                default:
                    return {
                        bg: "#ddd",
                        border: "#999",
                        icon: ""
                    };
            }
        }

        function renderEvent(opt) {
            if (opt.height > 50) {
                return `
                    <div class="event-item" style="
                        background:${opt.bg};
                        padding:4px 6px;
                        border-left:4px solid ${opt.border};
                        border-right:4px solid ${opt.border};
                        border-radius:4px;
                        font-size:13px;
                        font-weight:600;
                        position:absolute;
                        left:${opt.left}px;
                        top:${opt.top}px;
                        bottom:${opt.bottom}px;
                        height:${opt.height}px; 
                        width:${opt.width}px;
                    "
                    data-timeline-id=${opt.timeline_id}
                    >
                        <div style="font-size:10px;font-weight:400; z-index: 1; position: relative;">
                            ${opt.time}
                            ${opt.text}
                        </div>
                    </div>
                `;
            } else {
                return `
                        <div class="event-item" style="
                            background:${opt.bg};
                            padding:4px 6px;
                            border-left:4px solid ${opt.border};
                            border-right:4px solid ${opt.border};
                            border-radius:4px;
                            font-size:13px;
                            font-weight:600;
                            position:absolute;
                            left:${opt.left}px;
                            top:${opt.top}px;
                            bottom:${opt.bottom}px;
                            height:${opt.height}px;
                            width:${opt.width}px;
                            
                        ">$</div>
                    `;
            }
        }
        
        function loadMonthCounts(year, month) {
            let ym = `${year}-${String(month).padStart(2, '0')}`;

            $.ajax({
                url: base_url + 'calendar/getMonthEventCounts',
                type: 'GET',
                dataType: 'json',
                data: { month: ym },
                success: function (res) {
                    if (res.success) {
                        console.log(res.data); 
                        // [{date: "2026-02-01", total_events: 3}, ...]
                        renderDayBadges(res.data);
                    }
                }
            });
        }


        function getModalDate() {
            let current = $('#modalDateName').text().trim() || $('#modalDateName').val();
            return new Date(current);
        }

        function updateModalDate(d) {
            let newDate = d.toISOString().split('T')[0];

            $('#modalDateName').text(newDate);  // or .val(newDate) based on your element
            renderCalendarModal(d);             // your existing logic
        }


        $(document).on('click', '#prevDate', function () {
            let d = getModalDate();
            d.setDate(d.getDate() - 1);
            updateModalDate(d);
        });

        $(document).on('click', '#nextDate', function () {
            let d = getModalDate();
            d.setDate(d.getDate() + 1);
            updateModalDate(d);
        });

        $(document).on('click', '#prevMonth', function () {
            let d = getModalDate();
            d.setMonth(d.getMonth() - 1);
            updateModalDate(d);
        });

        $(document).on('click', '#nextMonth', function () {
            let d = getModalDate();
            d.setMonth(d.getMonth() + 1);
            updateModalDate(d);
        });

        $(document).on('click', '#prevYear', function () {
            let d = getModalDate();
            d.setFullYear(d.getFullYear() - 1);
            updateModalDate(d);
        });

        $(document).on('click', '#nextYear', function () {
            let d = getModalDate();
            d.setFullYear(d.getFullYear() + 1);
            updateModalDate(d);
        });

        // $(document).on('click', '#prevDate', function () {
        //     let current = $('#modalDateName').text().trim();
        //     let d = new Date(current);
        //     d.setDate(d.getDate() - 1);

        //     let newDate = d.toISOString().split('T')[0];

        //     $('#modalDateName').val(newDate);
        //     renderCalendarModal(d);
        // });

        // $(document).on('click', '#nextDate', function () {
        //     let current = $('#modalDateName').text().trim();
        //     let d = new Date(current);
        //     d.setDate(d.getDate() + 1);

        //     let newDate = d.toISOString().split('T')[0];

        //     $('#modalDateName').val(newDate);
        //     // console.log('d',d)
        //     renderCalendarModal(d);
        // });


        // === 🆕 Remaining Days + Months Left ===
        function updateRemainingDays() {
            const today = new Date();
            const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            const daysLeft = lastDay.getDate() - today.getDate();
            const monthsLeft = 11 - today.getMonth(); // remaining months in year
            const monthName = today.toLocaleString('default', {
                month: 'long'
            });

            // Left Box → Months Remaining
            let monthsText = monthsLeft > 0 ?
                `${monthsLeft}` :
                `1`;

            // Right Box → Days Remaining
            let daysText = daysLeft > 0 ?
                `${daysLeft}` :
                `Last day of ${monthName}!`;

            document.getElementById('remainingMonthsBox').textContent = monthsText;
            document.getElementById('remainingDaysBox').textContent = daysText;
        }

        updateRemainingDays();

        // === MINI CALENDAR ===
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        const miniMonthEl = document.getElementById('miniMonth');
        const miniGridEl = document.getElementById('miniGrid');

        function renderMiniCalendar() {
            miniGridEl.innerHTML = '';
            const weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
            weekdays.forEach(day => {
                const headerDiv = document.createElement('div');
                headerDiv.style.fontWeight = '600';
                headerDiv.style.textAlign = 'center';
                headerDiv.textContent = day;
                miniGridEl.appendChild(headerDiv);
            });

            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const startDay = firstDay.getDay();
            const totalDays = lastDay.getDate();

            miniMonthEl.textContent = firstDay.toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });

            for (let i = 0; i < startDay; i++) {
                const emptyDiv = document.createElement('div');
                miniGridEl.appendChild(emptyDiv);
            }

            const today = new Date();
            for (let d = 1; d <= totalDays; d++) {
                const date = new Date(currentYear, currentMonth, d);
                const div = document.createElement('div');
                div.textContent = d;

                if (date.getDate() === today.getDate() &&
                    date.getMonth() === today.getMonth() &&
                    date.getFullYear() === today.getFullYear()) {
                    div.classList.add('today');
                }

                div.addEventListener('click', function () {
                    document.querySelectorAll('#miniGrid .selected').forEach(el => el.classList.remove('selected'));
                    div.classList.add('selected');
                    mainCalendar.gotoDate(date);
                });

                miniGridEl.appendChild(div);
            }
        }

        document.getElementById('prevMonth').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderMiniCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderMiniCalendar();
        });

        renderMiniCalendar();

        // === MODAL CLOSE ===
        closeBtn.addEventListener("click", () => modal.style.display = "none");
        window.addEventListener("click", e => {
            if (e.target === modal) modal.style.display = "none";
        });

    });

    function getTimeSlots() {
        let times = [];
        for (let h = 0; h < 24; h++) {
            for (let m = 0; m < 60; m += 60) {

                let hour = h % 12 || 12;
                let ampm = h < 12 ? "AM" : "PM";
                let minutes = m.toString().padStart(2, '0');

                times.push(`${hour}:${minutes} ${ampm}`);
            }
        }
        return times;
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("viewEvent")) {
            e.preventDefault();

            const id = e.target.getAttribute("data-id");
            const type = e.target.getAttribute("data-type");

            if (type === "press_release") {
                window.location.href = '<?= base_url("company/press_release_preview?id="); ?>' + id;
            } else {
                window.location.href = '<?= base_url("company/preview_brick?id="); ?>' + id;
            }
        }
    });

    function addMinutesToTime(timeStr, minutesToAdd = 30) {
        const d = new Date();

        const [h, m, s] = timeStr.split(':').map(Number);
        d.setHours(h, m, s || 0, 0);   // set today’s date with your time
        d.setMinutes(d.getMinutes() + minutesToAdd);

        return d.toTimeString().slice(0, 8); // "HH:mm:ss"
    }

</script>




<!-- MODIFIED JS  -->
<script>
    // OPEN MODEL FOR Enable Disable Functionality
    function openModal() {
        document.getElementById('enableDisableModal').style.display = 'flex';
    }

    function closeModalEnableDisable() {
        document.getElementById('enableDisableModal').style.display = 'none';
    }
    document.getElementById('btnEnableDisable').addEventListener('click', function (e) {
        e.preventDefault();
        openModal();
    });
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('enableDisableModal');
        if (e.target === modal) {
            closeModalEnableDisable();
        }
    });
</script>

<!-- Shiv Web Developer  -->
<script>
    // Toggle section visibility
    document.querySelectorAll('.enableSwitch').forEach((switchElement) => {
        switchElement.addEventListener('change', function () {
            const index = this.getAttribute('data-index');
            const label = document.querySelector('.enableDisableLabel[data-index="' + index + '"]');
            const form = document.getElementById('conditionalForm' + index);
            const questionBox = document.getElementById('questionBox' + index);
            if (this.checked) {
                form.style.display = 'block';
                questionBox.style.borderBottom = 'none';
                label.textContent = 'Yes';
            } else {
                form.style.display = 'none';
                questionBox.style.borderBottom = '2px dotted #ccc';
                label.textContent = 'No';
            }
        });
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Close button
    document.getElementById("closeModal").onclick = function () {
        document.getElementById("dayModal").style.display = "none";
    };

    // Close when clicking outside modal
    window.onclick = function (e) {
        const modal = document.getElementById("dayModal");
        if (e.target === modal) {
            modal.style.display = "none";
        }
    };



    document.addEventListener("DOMContentLoaded", function () {

        const openBtn = document.getElementById("openModelforTimeStamp");
        const timeInputs = document.querySelectorAll("input.time-input");
        const timeOpen = timeInputs[0]; // First input = Opening
        const timeClose = timeInputs[1]; // Second input = Closing

        const modal = document.getElementById("timeStampModal");
        const closeBtn = document.getElementById("closeTimeStamp");
        // console.log("modal",modal)
        const showOpening = document.getElementById("showOpening");
        const showClosing = document.getElementById("showClosing");

        openBtn.addEventListener("click", function () {

            const opening = timeOpen.value.trim();
            const closing = timeClose.value.trim();

            if (opening === "" || closing === "") {
                alert("Please select both opening and closing time.");
                return;
            }

            // Optional: Validate Closing > Opening
            if (closing <= opening) {
                alert("Closing time must be greater than opening time.");
                return;
            }

            // PUT VALUES IN THE MODAL
            showOpening.textContent = opening;
            showClosing.textContent = closing;
            initTabs_old(modal);
            // OPEN MODAL
            modal.style.display = "flex";
        });

        // Close Modal
        closeBtn.addEventListener("click", () => modal.style.display = "none");

        window.addEventListener("click", (e) => {
            if (e.target === modal) modal.style.display = "none";
        });

    });
    
    document.addEventListener("DOMContentLoaded", function () {

        const openBtn = document.getElementById("openModelforDataFeeding");

        const modal = document.getElementById("dataFeedingModal");
        const closeBtn = document.getElementById("closeDataFeedingModal");

        const showOpening = document.getElementById("showOpening");
        const showClosing = document.getElementById("showClosing");

        openBtn.addEventListener("click", function () {

            initTabs(modal);
            // OPEN MODAL
            modal.style.display = "flex";
        });

        // Close Modal
        closeBtn.addEventListener("click", () => modal.style.display = "none");

        window.addEventListener("click", (e) => {
            if (e.target === modal) modal.style.display = "none";
        });

    });


    function initTabs_old(modal) {

        if (!modal) return;

        // 🔹 Hide all tabs inside this modal
        modal.querySelectorAll('.tab-box').forEach(tab => {
            tab.style.display = "none";
        });

        // 🔹 Show TEXT tab by default
        const textBox = modal.querySelector('#box_textbox');
        if (textBox) {
            textBox.style.display = "block";
        }
    }


    document.getElementById("project_component").addEventListener("change", function () {
        const selected = this.value;

        const routes = {
            task: "<?= base_url('/company/create-brick'); ?>",
            milestone: "<?= base_url('/company/create-brick'); ?>",
            strategie: "<?= base_url('/company/create-brick'); ?>",
            scene: "<?= base_url('/company/create-brick'); ?>",
            updates: "<?= base_url('/company/create-brick'); ?>",
            events: "<?= base_url('/company/create-brick'); ?>",
        };

        if (routes[selected]) {
            window.location.href = routes[selected];
        }
    });
</script>



<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

<script>
    $(document).ready(function () {

        document.addEventListener("click", function (e) {

            const btn = e.target.closest(".tab-btn");
            if (!btn) return;

            const box = btn.dataset.box;
            if (!box) return;

            // Scope to the current modal
            const modal = btn.closest(".calendar-modal");
            if (!modal) return;

            // Hide only this modal's tabs
            modal.querySelectorAll(".tab-box").forEach(tab => {
                tab.style.display = "none";
            });

            // Show selected tab
            const target = modal.querySelector(box);
            if (target) {
                target.style.display = "block";
            }
        });


    });


    function toMinutes(t, isClosing = false) {
        if (t === "00:00:00" && isClosing == true) return 1440;
        let [h, m] = t.split(':').map(Number);
        return h * 60 + m;
    }

    function isWithinRange(slot, start, end) {
        let s = toMinutes(slot);
        return s >= toMinutes(start) && s <= toMinutes(end);
    }

    function getStableColumnIndex(eventId, start, end, columns, eventColumnMap) {
        const MAX_COLS = 9;

        // 1️⃣ Already assigned → reuse
        if (eventColumnMap.has(eventId)) {
            return eventColumnMap.get(eventId);
        }

        // 2️⃣ Try to find a free column
        for (let i = 0; i < columns.length; i++) {
            if (columns[i] <= start) {
                columns[i] = end;
                eventColumnMap.set(eventId, i);
                return i;
            }
        }

        // 3️⃣ If columns not full yet → create new column
        if (columns.length < MAX_COLS) {
            const newIndex = columns.length;
            columns.push(end);
            eventColumnMap.set(eventId, newIndex);
            return newIndex;
        }

        // 4️⃣ ALL columns occupied → timeline FULL
        return null; // 🚫 do not place this event
    }



    function convertTo24(time12h) {
        let [time, meridian] = time12h.split(" ");
        let [h, m] = time.split(":").map(Number);

        if (meridian === "PM" && h !== 12) h += 12;
        if (meridian === "AM" && h === 12) h = 0;

        return (h < 10 ? "0" : "") + h + ":" + m;
    }

    function isTimeSlotFull(openingTime, closingTime, EVENTS) {
        // console.log("EVENTS", EVENTS);

        const startMin = toMinutes(openingTime);
        const endMin = toMinutes(closingTime);

        let overlapCount = 0;

        EVENTS.forEach(item => {
            const s = toMinutes(item.openingtime);
            const e = toMinutes(item.closingtime);

            // overlap check
            if (s < endMin && e > startMin) {
                overlapCount++;
            }
        });

        return overlapCount >= 9;
    }


    $(document).ready(function () {
        
        function getScheduleType(modal) {
            return modal.dataset.schedule === "future" ? 1 : 0;
        }

        function getFinalDateTime(modal) {

            if (getScheduleType(modal) === 1) return null;

            // 🔥 get date FROM THIS MODAL only
            const dateText = $(modal).find('#modalDateName').val();
            console.log("dateText", dateText);
            if (!dateText) return null;

            const d = new Date(dateText);
            if (isNaN(d)) return null;

            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');

            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }


        function getFinalDateOnly() {
            const d = new Date($("#modalDateName").text());
            return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
        }

        $(document).on('click', '.save-btn', function (e) {
            e.preventDefault();  

            const btn = this;
            const mode = btn.dataset.mode || 'create';
            const editId = btn.dataset.id || null;
            const modal = btn.closest('.calendar-modal');
            const $modal = $(modal);
            
            const scheduleType = getScheduleType(modal); // 0 or 1
            const type = $(btn).data('type');
            const url  = $(btn).data('url');

            let formData = new FormData();

            if (mode === 'edit' && editId) {
                formData.append('id', editId); // 🔥 send id for update
            }
            
            // ✅ Fixed / Future logic
            if (scheduleType === 0) {
                // console.log("showOpening", $modal.find("#showOpening"))
                formData.append("openingTime", $modal.find("#showOpening").text());
                formData.append("closingTime", $modal.find("#showClosing").text());

                const finalDateTime = getFinalDateTime(modal);
                formData.append("finaldatetime", finalDateTime);
            }

            formData.append("scheduleType", scheduleType);

            const timelineData = getDroppedTimelineData(
                modal.querySelector('.content_adding__container')
            );

            formData.append("timeline", JSON.stringify(timelineData));
            
            // ✅ MODAL-SCOPED DATA COLLECTION
            switch (type) {

                case "text":
                    formData.append(
                        "textbox",
                        $modal.find("#textbox").val()
                    );
                    break;

                case "image":
                    formData.append(
                        "imagefile",
                        $modal.find("#image")[0]?.files[0]
                    );
                    formData.append(
                        "imagelink",
                        $modal.find("#imagelink").val()
                    );
                    break;

                case "video":
                    formData.append(
                        "videofile",
                        $modal.find("#video")[0]?.files[0]
                    );
                    formData.append(
                        "videolink",
                        $modal.find("#videolink").val()
                    );
                    break;

                case "audio":
                    formData.append(
                        "audiofile",
                        $modal.find("#audio")[0]?.files[0]
                    );
                    formData.append(
                        "audiolink",
                        $modal.find("#audiolink").val()
                    );
                    break;

                case "docs":
                    formData.append(
                        "docsfile",
                        $modal.find("#docs")[0]?.files[0]
                    );
                    formData.append(
                        "docslink",
                        $modal.find("#docslink").val()
                    );
                    break;

                case "other":
                    formData.append(
                        "otherlink",
                        $modal.find("#otherlink").val()
                    );
                    formData.append(
                        "time",
                        $modal.find("#time").val()
                    );
                    formData.append(
                        "timeslot",
                        $modal.find("#timeslot").val()
                    );
                    formData.append(
                        "linkcategory",
                        $modal.find("#linkcategory").val()
                    );
                    break;
                case "contact":
                    formData.append(
                        "contact",
                        $modal.find("#contact").val()
                    );
            }

            // ✅ AJAX
            $.ajax({
                url,
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success(res) {
                    console.log(res)
                    alert(res.message);
                     // 🔥 Render output below dropped item
                    let wrapper = activeDroppedWrapper;

                    // 🔥 fallback for edit (find by id)
                    if (!wrapper && res.data_id) {
                        wrapper = modal.querySelector(
                            `.dropped-item[data-id="${res.data_id}"]`
                        );
                    }

                    if (wrapper) {
                        wrapper.dataset.type = res.type;
                        wrapper.dataset.id = res.data_id;
                        wrapper.dataset.timeline = res.timeline_id;

                        const output = wrapper.querySelector('.dropped-output');
                        if (output) {
                            output.innerHTML = renderOutputByType(type, modal);
                            output.style.display = 'block';
                        }
                    }


                    canDropNewItem = true;
                    activeDroppedWrapper = null;
                    clearModalByType($modal, type);
                },
                error(xhr) {
                    alert("AJAX Error");
                    console.error(xhr.responseText);
                }
            });
        });

        const taskStore = {};

        let currentEditTask = {
            id: null,
            type: null
        };

        $(document).on('click', '.fetch-btn', function (e) {
            e.preventDefault();

            const btn = this;
            const $modal = $(btn).closest('.calendar-modal');
            console.log($modal)
            
            const scheduleType = getScheduleType($modal[0]); // 0 or 1
            console.log(scheduleType)
            const url    = $(btn).data('url');
            const target = $(btn).data('target'); // e.g. ".result-box"
            const type   = $(btn).data('type');
            const finalDate = getFinalDateOnly();

            const $target = $modal.find(target); // 🔥 IMPORTANT

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    date: finalDate,
                    scheduleType: scheduleType
                },
                dataType: "json",

                success(response) {
                    console.log("response",response);
                    if (!taskStore[type]) taskStore[type] = {};

                    response.data.forEach(item => {
                        taskStore[type][item.id] = item;
                    });

                    let html = `<div class="textdatashowcaselist mt-5">`;

                    response.data.forEach((item, index) => {
                        html += buildRow(type, item, index, response.user);
                    });

                    html += `</div>`;

                    $target.html(html); // ✅ render INSIDE this modal only
                    initTaskFunctions();
                },

                error(xhr) {
                    console.error(xhr.responseText);
                    alert("AJAX Error");
                }
            });
        });

        function renderOutputByType(type, modal) {
            switch (type) {

                case 'text': {
                    const text = modal.querySelector('#textbox')?.value || '';
                    return `
                        <div class="timeline-output text-output">
                            <span>${text}</span>
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'image': {
                    const img = modal.querySelector('#imagelink')?.value;
                    return `
                        <div class="timeline-output image-output">
                            ${img ? `<img src="${img}" width="50" height="50" class="rounded border">` : '<span>Image uploaded</span>'}
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'video': {
                    const link = modal.querySelector('#videolink')?.value;
                    return `
                        <div class="timeline-output video-output">
                            <i class="fa-solid fa-video me-1"></i>
                            <span>${link || 'Video uploaded'}</span>
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'audio': {
                    const link = modal.querySelector('#audiolink')?.value;
                    return `
                        <div class="timeline-output audio-output">
                            <i class="fa-solid fa-music me-1"></i>
                            <span>${link || 'Audio uploaded'}</span>
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'docs': {
                    const link = modal.querySelector('#docslink')?.value;
                    return `
                        <div class="timeline-output docs-output">
                            <i class="fa-solid fa-file-lines me-1"></i>
                            <span>${link || 'Document uploaded'}</span>
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'other': {
                    const link = modal.querySelector('#otherlink')?.value;
                    const time = modal.querySelector('#time')?.value;
                    const slot = modal.querySelector('#timeslot')?.value;

                    return `
                        <div class="timeline-output other-output">
                            <i class="fa-solid fa-link me-1"></i>
                            <span>${link}</span>
                            ${time ? `<small class="text-muted ms-2">(${time} ${slot})</small>` : ''}
                           <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                case 'contact': {
                    const contact = modal.querySelector('#contact')?.value;
                    return `
                        <div class="timeline-output contact-output">
                            <i class="fa-solid fa-phone me-1"></i>
                            <span>${contact}</span>
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item">
                                <i class="bi bi-trash delete-item" title="Delete"></i>
                            </span>
                        </div>
                    `;
                }

                default:
                    return `<div class="timeline-output"><span>Saved</span></div>`;
            }
        }



        function buildRow(type, item, index, user) {

            switch (type) {

                case "text":
                    return `
                        <div class="datalist">
                            <hr>

                            <div class="d-flex align-items-center gap-3 mb-2">

                                <img
                                    class="calender_task_profile_pic"
                                    src="${getUserImage(user)}"
                                    alt="User"
                                >

                                <div class="flex-grow-1">
                                    <div class="fw-semibold">
                                        ${getUserName(user)}
                                    </div>
                                </div>
                                <span class="badge bg-primary">${getEventType(item.schedule_type)}</span>
                                <div class="text-muted small">
                                    ${new Date(item.created_date).toLocaleString('en-IN', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    })}
                                </div>
                            </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="pt-2">${index + 1}. ${item.textbox_description}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 mt-2">
                                    <span class="badge bg-primary">TEXT</span>
                                    <div class="d-flex align-items-center">
                                        <input type="datetime-local" name="artificialdate" id="datetime-local" class="form-control px-2 py-1" placeholder="Date &amp; Time" style="width:280px;">
                                        <span class="btn btn-primary btn-sm">Allocate</span>
                                    </div>
                                    <div>
                                        <a data-id="${item.id}" data-type="${type}" title="Edit Task" class="text-center me-2 edit_task">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a data-id="${item.id}" data-type="${type}" title="Delete Task" class="text-center text-danger delete_task">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            `;

                case "image":
                    return `
                        <div class="datalist">
                            <hr>
                            <p>${index + 1}.
                                <a href="<?= base_url('/uploads/calendar_image/') ?>${item.image}" target="_blank">
                                    <img src="<?= base_url('/uploads/calendar_image/') ?>${item.image}" style="height:40px;width:40px">
                                </a>
                                ---
                                <a href="${item.imagelink}" target="_blank">
                                    <img src="${item.imagelink}" style="height:40px;width:40px">
                                </a>
                            </p>
                        </div>`;

                case "docs":
                    return `
                        <div class="datalist">
                            <hr>
                            <p>${index + 1}.
                                <a href="<?= base_url('/uploads/calendar_docs/') ?>${item.docs}" target="_blank">
                                    <img src="<?= base_url('/uploads/calendar_docs/') ?>${item.docs}" style="height:40px;width:40px">
                                </a>
                                ---
                                <a href="${item.docslink}" target="_blank">
                                    <img src="${item.docslink}" style="height:40px;width:40px">
                                </a>
                            </p>
                        </div>`;

                case "video":
                    return `
                        <div class="datalist">
                            <hr>
                            <p>${index + 1}.
                                <video width="200" height="100" controls>
                                    <source src="<?= base_url('/uploads/calendar_video/') ?>${item.video}" type="video/mp4">
                                </video>
                                <a href="${item.videolink}" target="_blank">Open Link</a>
                            </p>
                        </div>`;

                case "audio":
                    return `
                        <div class="datalist">
                            <hr>
                            <p>${index + 1}.
                                <audio controls>
                                    <source src="<?= base_url('/uploads/calendar_audio/') ?>${item.audio}">
                                </audio>
                                <a href="${item.audiolink}" target="_blank">Open Link</a>
                            </p>
                        </div>`;

                case "other":
                    return `
                        <div class="datalist">
                            <hr>
                            <p>${index + 1}. ${item.linkcategory} —
                                <a href="${item.otherlink}" target="_blank">${item.otherlink}</a>
                                (${item.time} ${item.timeslot})
                            </p>
                        </div>`;
                default:
                    console.warn('Unknown type:', type, item);
                    return '';
            }
        }
        
        function clearModalByType($modal, type) {

            /* =========================
                COMMON (ALL TYPES)
            ========================= */
            $modal.find("input[type='text'], input[type='url'], textarea").val("");
            $modal.find("select").prop("selectedIndex", 0);

            // Clear time / date UI
            $modal.find("#showOpening").text("");
            $modal.find("#showClosing").text("");
            $modal.find(".time-slot, .date-slot").removeClass("active");

            /* =========================
                TYPE-SPECIFIC CLEARING
            ========================= */
            switch (type) {

                /* -------- TEXT -------- */
                case "text":
                $modal.find("#textbox").val("");
                break;

                /* -------- IMAGE -------- */
                case "image":
                $modal.find("#image").val(null);
                $modal.find("#imagelink").val("");
                $modal.find(".image-preview, .file-preview").empty();
                break;

                /* -------- VIDEO -------- */
                case "video":
                $modal.find("#video").val(null);
                $modal.find("#videolink").val("");
                $modal.find(".video-preview, .file-preview").empty();
                break;

                /* -------- AUDIO -------- */
                case "audio":
                $modal.find("#audio").val(null);
                $modal.find("#audiolink").val("");
                $modal.find(".audio-preview, .file-preview").empty();
                break;

                /* -------- DOCS -------- */
                case "docs":
                $modal.find("#docs").val(null);
                $modal.find("#docslink").val("");
                $modal.find(".docs-preview, .file-preview").empty();
                break;

                /* -------- OTHER -------- */
                case "other":
                $modal.find("#otherlink").val("");
                $modal.find("#time").val("");
                $modal.find("#timeslot").val("");
                $modal.find("#linkcategory").prop("selectedIndex", 0);
                break;
            }

            /* =========================
                OPTIONAL UI CLEANUP
            ========================= */
            $modal.find(".is-invalid").removeClass("is-invalid");
            $modal.find(".error-message").remove();
        }

        function initTaskFunctions() {

            const edit_task_modal = document.getElementById("editTaskModal");
            const close_modal_edit_task_btn = document.getElementById("closeEditTaskModal");
            console.log('edit_task_modal', edit_task_modal);
            
            document.querySelectorAll(".edit_task").forEach(btn => {
                btn.addEventListener("click", function () {

                    const { id, type } = this.dataset;

                    // ✅ get task from memory
                    const task = taskStore[type]?.[id];

                    if (!task) {
                        alert("Task data not found");
                        return;
                    }
                    
                    currentEditTask.id = id;
                    currentEditTask.type = type;
                    edit_task_modal.dataset.schedule = task.schedule_type;

                    // ✅ populate modal
                    populateEditModal(type, task);
                    
                    edit_task_modal.style.display = "flex";
                });
            });

            const closeBtn = document.getElementById("closeEditTaskModal");
                if (closeBtn) {
                closeBtn.addEventListener("click", () => {
                    const modal = document.getElementById("editTaskModal");
                    if (modal) modal.style.display = "none";
                });
            }


            window.addEventListener("click", (e) => {
                const modal = document.getElementById("editTaskModal");
                if (!modal) return;

                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });


        }

        function populateEditModal(type, task) {

            // 1️⃣ Hide all edit sections
            document.querySelectorAll(".edit-section").forEach(el => {
                el.style.display = "none";
            });

            // 2️⃣ Find correct section by type
            const section = document.querySelector(
                `.edit-section[data-edit-type="${type}"]`
            );

            if (!section) {
                console.error("Edit section not found for type:", type);
                return;
            }

            // 3️⃣ Show section
            section.style.display = "block";

            // 4️⃣ Helper to safely set value
            const setValue = (id, value = "") => {
                const el = document.getElementById(id);
                if (el) el.value = value;
                else console.warn(`Missing input: #${id}`);
            };

            // 5️⃣ Fill data based on type
            switch (type) {

                case "text":
                setValue("edit_textbox", task.textbox_description);
                break;

                case "image":
                setValue("edit_imagelink", task.imagelink);
                break;

                case "video":
                setValue("edit_videolink", task.videolink);
                break;

                case "audio":
                setValue("edit_audiolink", task.audiolink);
                break;

                case "docs":
                setValue("edit_docslink", task.docslink);
                break;

                default:
                console.warn("Unhandled edit type:", type);
            }
        }

        document.getElementById("updateTaskBtn").addEventListener("click", function () {

            if (!currentEditTask.id || !currentEditTask.type) {
                alert("Invalid task state");
                return;
            }

            const modal = document.getElementById("editTaskModal");
            const scheduleType = modal.dataset.schedule || 0;

            const formData = new FormData();

            // ✅ COMMON
            formData.append("id", currentEditTask.id);
            formData.append("scheduleType", scheduleType);

            // Final date (reuse your existing helper)
            formData.append("finaldatetime", getFinalDateTime(modal));

            // Only for fixed schedule
            if (parseInt(scheduleType) === 0) {
                formData.append("openingTime", modal.querySelector("#showOpening")?.innerText || "");
                formData.append("closingTime", modal.querySelector("#showClosing")?.innerText || "");
            }

            // ✅ TYPE-SPECIFIC DATA
            switch (currentEditTask.type) {

                case "text":
                formData.append(
                    "textbox",
                    document.getElementById("edit_textbox").value.trim()
                );
                break;

                case "image":
                formData.append(
                    "imagelink",
                    document.getElementById("edit_imagelink").value.trim()
                );
                break;

                case "video":
                formData.append(
                    "videolink",
                    document.getElementById("edit_videolink").value.trim()
                );
                break;

                case "audio":
                formData.append(
                    "audiolink",
                    document.getElementById("edit_audiolink").value.trim()
                );
                break;

                case "docs":
                formData.append(
                    "docslink",
                    document.getElementById("edit_docslink").value.trim()
                );
                break;
            }

            // ✅ AJAX CALL (REUSING SAVE API)
            fetch("<?= base_url('Calendar/saveTextbox') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(res => {

                    if (!res.success) {
                        alert(res.message || "Update failed");
                        return;
                    }

                    alert("Task updated successfully!");

                    // ✅ Update local store (important)
                    updateTaskStoreAfterEdit(currentEditTask, formData);

                    // Close modal
                    modal.style.display = "none";
                })
                .catch(err => {
                console.error(err);
                alert("Server error");
                });

        });
        
        function updateTaskStoreAfterEdit(ctx, formData) {
            const task = taskStore[ctx.type]?.[ctx.id];
            if (!task) return;

            for (let [key, value] of formData.entries()) {
                if (key !== "id") {
                task[key] = value;
                }
            }
        }
        
        $(document).on("click", ".delete_task", function (e) {
            e.preventDefault();

            const btn = this;
            const { id, type } = btn.dataset;

            if (!id || !type) {
                alert("Invalid task");
                return;
            }

            if (!confirm("Are you sure you want to delete this task?")) {
                return;
            }

            $.ajax({
                url: "<?= base_url('Calendar/deleteTask') ?>",
                type: "POST",
                dataType: "json",
                data: {
                id: id,
                type: type
                },
                success(res) {
                if (!res.success) {
                    alert(res.message || "Delete failed");
                    return;
                }

                // ✅ Remove from memory
                if (taskStore[type] && taskStore[type][id]) {
                    delete taskStore[type][id];
                }

                // ✅ Remove from UI
                $(btn).closest(".datalist").remove();

                alert("Task deleted successfully!");
                },
                error(xhr) {
                console.error(xhr.responseText);
                alert("Server error");
                }
            });
        });
        
        function restoreTimeline(modal, timelineData) {
            const dropContainer = modal.querySelector('.content_adding__container');
            const inputArea = modal.querySelector('#borderBoxesInputAreaContainer');

            dropContainer.innerHTML = '';
            inputArea.style.display = 'block';

            timelineData.items.forEach(item => {
                // Find original toolbar button by data-type
                const sourceBtn = modal.querySelector(
                    `.draggable-btn[data-type="${item.content_type}"]`
                );

                if (!sourceBtn) return;

                const clone = sourceBtn.cloneNode(true);
                clone.classList.remove('draggable-btn');
                clone.removeAttribute('draggable');
                clone.classList.add('d-inline', 'w-fill-content');

                const wrapper = document.createElement('div');
                wrapper.classList.add('dropped-item', 'mb-2');

                const dot = document.createElement('span');
                dot.classList.add('dot');

                wrapper.appendChild(dot);
                wrapper.appendChild(clone);
                dropContainer.appendChild(wrapper);

                // 🔥 Unhide related input box
                const boxSelector = clone.getAttribute('data-box');
                if (boxSelector) {
                    const box = inputArea.querySelector(boxSelector);
                    if (box) box.style.display = 'block';
                }
            });
        }

        function loadTimeline(modal) {
            $.post("<?= base_url('Calendar/getTimeline') ?>", {
                date: getFinalDateOnly(),
                openingTime: modal.querySelector('#showOpening')?.innerText,
                closingTime: modal.querySelector('#showClosing')?.innerText,
                scheduleType: modal.dataset.schedule === "future" ? 1 : 0
            }, function (res) {
                if (res.success && res.data) {
                    restoreTimeline(modal, res.data);
                }
            }, "json");
        }

    });
</script>

<script>
    function getUserName(user) {
        if (user.name) return user.name;
        if (user.email) return user.email;
        return "Anonymous";
    }

    function getUserImage(user) {
        return user.user_image
            ? `<?= base_url('uploads/user_profile/') ?>${user.user_image}`
            : `<?= base_url('assets/images/img/user.png') ?>`;
    }
    
    function getEventType(schedule){
        if(schedule === '0'){
            return 'Fixed'
        }else{
            return 'Future'
        }
    }

</script> 

<!-- SEARCH FILTER TOGGLE FUNCTIONALITY  -->
<script>
    const box = document.getElementById("searchFilterBox");

    document.getElementById("openSearchFilter").onclick = () => {
        box.classList.add("active");
    };

    document.getElementById("closeSearchFilter").onclick = () => {
        box.classList.remove("active");
    };
</script>


<!-- CHAT MODEL OPEN FROM THIS  -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log(document.getElementById("chatOpen"));
        document.getElementById("chatOpen").addEventListener("click", function () {
            console.log('chat btn clicked')
            document.getElementById("chatModal").style.display = "block";
        });

        document.getElementById("chatClose").addEventListener("click", function () {
            document.getElementById("chatModal").style.display = "none";
        });

        window.addEventListener("click", function (e) {
            const modal = document.getElementById("chatModal");
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });
    })
</script>



<!-- CHAT MODULE USER SEARCH FUNCTIONALITY -->
<script>
    $(document).ready(function () {

        // Tagify initialization for Create Channel
        var inputElm = document.querySelector('#team-member-input');

        function tagTemplate(tagData) {
            return `
            <tag title="${tagData.email || ''}" 
                 contenteditable='false' 
                 spellcheck='false' 
                 tabIndex="-1" 
                 class="tagify__tag" 
                 value="${tagData.value}">
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                         class="rounded-circle me-2" 
                         style="width: 24px; height: 24px;">
                    <div>
                        <div class="fw-bold">${tagData.label || tagData.value}</div>
                        <small class="text-muted">${tagData.email || ''}</small>
                    </div>
                </div>
            </tag>
        `;
        }

        function suggestionItemTemplate(tagData) {
            return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">
                ${tagData.avatar ? `
                <div class='tagify__dropdown__item__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
                </div>` : ''
                }
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        `;
        }

        function dropdownHeaderTemplate(suggestions) {
            return `
            <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
                <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
                <span>${suggestions.length} members</span>
            </div>
        `;
        }

        // Initialize Tagify for 1D module
        var tagify = new Tagify(inputElm, {
            tagTextProp: 'name',
            enforceWhitelist: true,
            skipInvalid: true,
            dropdown: {
                closeOnSelect: false,
                enabled: 0,
                classname: 'users-list',
                searchKeys: ['name', 'email']
            },
            templates: {
                tag: tagTemplate,
                dropdownItem: suggestionItemTemplate,
                dropdownHeader: dropdownHeaderTemplate
            },
            whitelist: []
        });


        // Listen to input event for dynamic search (1D module)
        tagify.on('input', function (e) {
            var value = e.detail.value.trim();
            tagify.loading(true);

            fetch('<?php echo base_url('Home/searchUsers'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    search: value
                })
            })
                .then(response => response.json())
                .then(data => {
                    tagify.loading(false);
                    if (data.success && Array.isArray(data.users)) {
                        tagify.settings.whitelist = data.users.map(user => ({
                            value: user.id,
                            name: user.name,
                            label: user.name,
                            email: user.email,
                            avatar: user.avatar || 'assets/user-icon.png'
                        }));
                        tagify.dropdown.show(value);
                    } else {
                        tagify.settings.whitelist = [];
                        tagify.dropdown.hide();
                        alert('No users found or invalid response from server.');
                    }
                })
                .catch(error => {
                    tagify.loading(false);
                    console.error('Error searching users:', error);
                    alert('Failed to search users: ' + error.message);
                });
        });


        // Add to Our Portfolio
        $('#user_add_to_Portfolio').on('submit', function (e) {
            e.preventDefault();
            // const team_member_input = $('#team-member-input').val();
            const team_member_input = JSON.parse($('#team-member-input').val());
            const userId = team_member_input[0].value;

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: {
                    chat_with_user: userId,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function (xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });


    });



    // GET ALREADY ADDED USER LIST IN PORTFOLIO
    $(document).ready(function () {

        $('#seeAllUsersList').on('click', function () {

            const container = $('#userListContainer');

            // Toggle if already loaded
            if (container.is(':visible')) {
                container.slideUp();
                return;
            }

            $.ajax({
                url: "<?= base_url('company/chat/get_chat_users') ?>",
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    container.html('<p class="text-center">Loading users...</p>');
                },
                success: function (response) {

                    if (response.success) {
                        container.html(response.html);
                        container.slideDown();
                    } else {
                        container.html('<p class="text-danger text-center">' + response.message + '</p>');
                        container.slideDown();
                    }
                },
                error: function (xhr) {
                    container.html('<p class="text-danger text-center">Something went wrong</p>');
                    console.log(xhr.responseText);
                    container.slideDown();
                }
            });

        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const openBtn = document.getElementById("future-modal-btn");

        const modal = document.getElementById("futureTaskModal");
        const closeBtn = document.getElementById("closeTimeStampFuture");

        openBtn.addEventListener("click", function () {
            initTabs(modal)
            // OPEN MODAL
            modal.style.display = "flex";
        });

        // Close Modal
        closeBtn.addEventListener("click", () => modal.style.display = "none");

        window.addEventListener("click", (e) => {
            if (e.target === modal) modal.style.display = "none";
        });

    });

    function initTabs(modal) {

        if (!modal) return;
        console.log(modal);

        console.log(modal.querySelector('#borderBoxesInputAreaContainer'))

        // 🔹 Hide all tabs inside this modal
        modal.querySelectorAll('.tab-box').forEach(tab => {
            tab.style.display = "none";
        });

        modal.querySelector('#box_textbox').style.display = "block";
        
        // modal.querySelector('#borderBoxesInputAreaContainer').style.display = "none";
        
    }

    
</script>

<script>
    let draggedElement = null;
    let canDropNewItem = true;
    let activeDroppedWrapper = null;


    document.addEventListener('dragstart', (e) => {
        if (e.target.classList.contains('draggable-btn')) {
            draggedElement = e.target;
        }
    });

    document.addEventListener('dragover', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');

        if (!dropContainer) return;

        e.preventDefault();

        dropContainer.classList.add('drag-over');
    });

    document.addEventListener('dragleave', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');

        if (!dropContainer) return;

        dropContainer.classList.remove('drag-over');
    });

    document.addEventListener('drop', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');
        if (!dropContainer || !draggedElement) return;

        // ❌ BLOCK if previous item not saved
        if (!canDropNewItem) {
            alert('Please save the current item before adding another.');
            return;
        }

        e.preventDefault();
        dropContainer.classList.remove('drag-over');

        const boxSelector = draggedElement.getAttribute('data-box');
        const inputArea = document.getElementById('borderBoxesInputAreaContainer');
        
        // Show input area & hide others
        if (inputArea) {
            inputArea.style.display = 'block';
            inputArea.querySelectorAll('.tab-box').forEach(b => b.style.display = 'none');
        }

        // Create dropped item
        const clone = draggedElement.cloneNode(true);
        clone.classList.remove('draggable-btn');
        clone.classList.add('d-inline', 'w-fill-content');
        clone.removeAttribute('draggable');

        const wrapper = document.createElement('div');
        wrapper.classList.add('dropped-item', 'mb-2');

        const dot = document.createElement('span');
        dot.classList.add('dot');

        // 🔥 output placeholder
        const output = document.createElement('div');
        output.classList.add('dropped-output', 'mt-2');
        output.style.display = 'none';

        wrapper.appendChild(dot);
        wrapper.appendChild(clone);
        wrapper.appendChild(output);
        dropContainer.appendChild(wrapper);
        
        // ✅ Show related input + RESET SAVE MODE HERE
        if (boxSelector && inputArea) {
            const box = inputArea.querySelector(boxSelector);
            if (box) {
                box.style.display = 'block';

                // 🔥 RESET save button to CREATE mode
                const saveBtn = box.querySelector('.save-btn');
                if (saveBtn) {
                    saveBtn.dataset.mode = 'create';
                    delete saveBtn.dataset.id;
                    saveBtn.textContent = 'Save';
                }
            }
        }


        // Show related input
        if (boxSelector && inputArea) {
            const box = inputArea.querySelector(boxSelector);
            if (box) box.style.display = 'block';
        }

        // 🔒 LOCK next drop
        canDropNewItem = false;
        activeDroppedWrapper = wrapper;

        draggedElement = null;
    });
 
    function getDroppedTimelineData(container) {
        const items = container.querySelectorAll('.dropped-item button');
        return Array.from(items).map((btn, index) => ({
            type: btn.getAttribute('data-type'),
            position: index + 1
        }));
    }
    
    document.addEventListener('click', function (e) {

        const editIcon = e.target.closest('.edit-item');
        // console.log('editIcon', editIcon);
        
        if (!editIcon) return;

        const droppedItem = editIcon.closest('.dropped-item');
        // console.log('droppedItem', droppedItem);
        
        if (!droppedItem) return;
        
        activeDroppedWrapper = droppedItem;   // 🔥 THIS IS THE KEY
        canDropNewItem = false;

        const type = droppedItem.dataset.type;
        const id   = droppedItem.dataset.id;

        // 🔥 SCOPE TO MODAL
        const modal = droppedItem.closest('.calendar-modal');
        // console.log('modal', modal);

        if (!modal) return;

        const inputArea = modal.querySelector('#borderBoxesInputAreaContainer');
        // console.log('inputArea', inputArea);

        if (!inputArea) return;

        // Highlight active item
        modal.querySelectorAll('.dropped-item')
            .forEach(i => i.classList.remove('active'));

        droppedItem.classList.add('active');

        inputArea.style.display = 'block';

        // Hide all input boxes (SCOPED)
        inputArea.querySelectorAll('.tab-box')
                .forEach(b => b.style.display = 'none');

        // console.log("inputArea",inputArea);

        // Show correct input box
        const box = inputArea.querySelector(`#box_${type}box`);
        // console.log('box', box);
        // console.log('type', type);
        if (!box) return;

        box.style.display = 'block';

        // Load data into inputs
        loadItemData(type, id, box);

        e.preventDefault();
        e.stopPropagation();
    });




    function loadItemData(type, id, box) {
        fetch(`<?= base_url('/Calendar/getItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, id })
        })
        .then(res => res.json())
        .then(res => {
            if (!res.success) return alert('Failed to load data');

            const data = res.data;

            switch (type) {
                case 'text':
                    box.querySelector('#textbox').value = data.textbox_description;
                    break;

                case 'image':
                    box.querySelector('#imagelink').value = data.imagelink;
                    break;

                case 'video':
                    box.querySelector('#videolink').value = data.videolink;
                    break;

                case 'audio':
                    box.querySelector('#audiolink').value = data.audiolink;
                    break;

                case 'contact':
                    box.querySelector('#contact').value = data.contact;
                    break;
            }

            // Store edit id
            box.querySelector('.save-btn').dataset.id = data.id;
            box.querySelector('.save-btn').dataset.mode = 'edit';
        });
    }
    
    document.addEventListener('click', function (e) {

        const deleteIcon = e.target.closest('.delete-item');
        if (!deleteIcon) return;

        const item = deleteIcon.closest('.dropped-item');
        if (!item) return;

        const type = item.dataset.type;
        const id   = item.dataset.id;

        if (!confirm('Delete this item?')) return;

        fetch(`<?= base_url('Calendar/deleteItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, id })
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                item.remove();
                canDropNewItem = true;
                activeDroppedWrapper = null;
                document.getElementById('borderBoxesInputAreaContainer').style.display = 'none';
            }
        });

        e.preventDefault();
        e.stopPropagation();
    });


</script>

<script>
    let searchUserElem = document.getElementById('searchUserElem');

    function tagTemplate(tagData) {
        return `
        <tag title="${tagData.email || ''}" 
                contenteditable='false' 
                spellcheck='false' 
                tabIndex="-1" 
                class="tagify__tag" 
                value="${tagData.value}">
            <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
            <div class="d-flex align-items-center">
                <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                        class="rounded-circle me-2" 
                        style="width: 24px; height: 24px;">
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        </tag>
    `;
    }

    function suggestionItemTemplate(tagData) {
        return `
        <div ${this.getAttributes(tagData)}
            class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
            tabindex="0"
            role="option">
            ${tagData.avatar ? `
            <div class='tagify__dropdown__item__avatar-wrap'>
                <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
            </div>` : ''
            }
            <div>
                <div class="fw-bold">${tagData.label || tagData.value}</div>
                <small class="text-muted">${tagData.email || ''}</small>
            </div>
        </div>
    `;
    }

    function dropdownHeaderTemplate(suggestions) {
        return `
        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
            <span>${suggestions.length} members</span>
        </div>
    `;
    }
    // console.log("searchUserElem",searchUserElem)

    var userSearch = new Tagify(searchUserElem, {
        tagTextProp: 'name',
        enforceWhitelist: true,
        skipInvalid: true,
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name', 'email']
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate,
            dropdownHeader: dropdownHeaderTemplate
        },
        whitelist: []
    });

    userSearch.on('input', function(e) {
        var value = e.detail.value.trim();
        userSearch.loading(true);

        fetch('<?php echo base_url('AdminHome/searchUsers'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    search: value
                })
            })
            .then(response => response.json())
            .then(data => {
                userSearch.loading(false);
                if (data.success && Array.isArray(data.users)) {
                    userSearch.settings.whitelist = data.users.map(user => ({
                        value: user.id,
                        name: user.name,
                        label: user.name,
                        email: user.email,
                        avatar: user.avatar || 'assets/user-icon.png'
                    }));
                    userSearch.dropdown.show(value);
                } else {
                    userSearch.settings.whitelist = [];
                    userSearch.dropdown.hide();
                    alert('No users found or invalid response from server.');
                }
            })
            .catch(error => {
                userSearch.loading(false);
                console.error('Error searching users:', error);
                alert('Failed to search users: ' + error.message);
            });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        let activeTimeline = null;
        const timelineContainer = document.getElementById("timeline_container");
        const menu = document.getElementById("contextMenu");
        const menuAddUser = document.getElementById("menuAddUser");
        let treeId = $('#tree_select').val();
        let draggedUser = null;
        let selectedUser = null;
        let connectionStartUser = null;
        let connections = [];
        let activeUser = null;
        const userMenu = document.getElementById("userContextMenu");
        const menuRemoveUser = document.getElementById("menuRemoveUser");


        /* ===============================
        RENDER TIMELINES
        =============================== */
        function renderTimeLineNew(branches) {

            timelineContainer.innerHTML = '';

            const row = document.createElement("div");
            row.className = "d-flex flex-column";

            branches.forEach(branch => {

                const timeline = document.createElement("div");
                timeline.className = "my_timeline my-2 py-4";
                timeline.dataset.id = branch.id;

                const line = document.createElement("span");
                line.className = "my_timeline_line";

                // 🔥 ALWAYS create users wrapper
                const usersWrapper = document.createElement("div");
                usersWrapper.className = "timeline-users";

                timeline.appendChild(line);
                timeline.appendChild(usersWrapper);

                row.appendChild(timeline);
            });

            timelineContainer.appendChild(row);
        }


        /* ===============================
        RIGHT CLICK (EVENT DELEGATION)
        =============================== */
        document.addEventListener("contextmenu", function (e) {
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            if (e.target.closest(".timeline-user")) return;

            const timeline = e.target.closest(".my_timeline");
            if (!timeline) return;

            e.preventDefault();
            activeTimeline = timeline;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = contextMenu.offsetWidth;
            const menuHeight = contextMenu.offsetHeight;

            let left = x;
            let top = y + 50;

            if (left + menuWidth > rect.width) {
                left = rect.width - menuWidth - 5;
            }
            if (top + menuHeight > rect.height) {
                top = rect.height - menuHeight - 5;
            }

            contextMenu.style.left = left + "px";
            contextMenu.style.top = top + "px";
            contextMenu.style.display = "block";

            userContextMenu.style.display = "none";
        });



        /* ===============================
        ADD USER (TAGIFY)
        =============================== */
        menuAddUser.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeTimeline) return;

            // Prevent duplicate input
            if (activeTimeline.querySelector(".tagify")) return;

            const input = document.createElement("input");
            input.placeholder = "Add users...";
            input.className = "user-input";

            activeTimeline.appendChild(input);

            initTagify(input, activeTimeline.dataset.id);

            menu.style.display = "none";
        });

        /* ===============================
        INIT TAGIFY WITH DB SEARCH
        =============================== */
        function initTagify(inputElm, timelineId) {

            const tagify = new Tagify(inputElm, {
                tagTextProp: "name",
                enforceWhitelist: true,
                skipInvalid: true,
                dropdown: {
                    enabled: 1,
                    searchKeys: ["name", "email"]
                },
                whitelist: [],
                templates: {
                    dropdownItem: suggestionItemTemplate,
                }
            });

            // 🔍 Search users from DB
            tagify.on("input", function (e) {
                const value = e.detail.value.trim();
                if (!value) return;

                tagify.loading(true);

                fetch("<?= base_url('Home/searchUsersNew') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ search: value })
                })
                .then(res => res.json())
                .then(res => {
                    tagify.loading(false);

                    if (!res.success || !Array.isArray(res.users)) {
                        tagify.settings.whitelist = [];
                        return;
                    }

                    const safeUsers = res.users
                        .filter(u => u && u.name) // ✅ REMOVE BAD DATA
                        .map(u => ({
                            value: String(u.value),   // must be string
                            name: String(u.name),     // must be string
                            email: u.email || '',
                            avatar: u.avatar || ''
                        }));

                    tagify.settings.whitelist = safeUsers;

                    if (safeUsers.length) {
                        if (value && safeUsers.length) {
                            tagify.dropdown.show(value);
                        }
                    }

                });
            });

            // ➕ Save user to timeline
            tagify.on("add", function (e) {
                saveUserToTimeline(timelineId, e.detail.data, function (status, json) {
                    // console.log('status:', status);
                    if (status === 'success') {
                        // ✅ 1. Render user immediately
                        renderUserOnTimeline(json.user, timelineId);

                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove();

                    }else if(status === 'duplicate') {
                        $('#duplicate_user_alert').text('⚠️ This user is already added to the timeline.')
                            .removeClass('d-none')
                            .fadeIn();


                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove()

                        // ✅ 4. Auto hide alert after 3 seconds (optional)
                        setTimeout(() => {
                            $('#duplicate_user_alert').fadeOut();
                        }, 4000);
                    }
                });
            });

        }

        /* ===============================
        SAVE USER ↔ TIMELINE
        =============================== */
        function saveUserToTimeline(timelineId, user, callback) {
            $.ajax({
                url: "<?= base_url('Home/add_user_to_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    "tree_id" : treeId,
                    "timeline_id" : timelineId,
                    "user_id" : user.value
                },
                success: (json)=>{
                    callback(json.status, json);
                },
                error: (e)=>{
                    callback(false, null);
                }
            })
        }

        /* ===============================
        RENDER USER ON TIMELINE
        =============================== */

        function renderUserOnTimeline(user, timelineId) {

            const timeline = document.querySelector(
                `.my_timeline[data-id="${timelineId}"]`
            );
            if (!timeline) return;

            const usersWrapper = timeline.querySelector(".timeline-users");
            if (!usersWrapper) return;

            const div = document.createElement("div");
            div.className = "timeline-user";
            div.draggable = true;
            div.dataset.userId = user.id || user.user_id;
            div.dataset.timelineId = timelineId;
            // console.log('user.id', user.id);
            
            div.innerHTML = `
            <a href="<?= base_url('company/user_preview?id=') ?>${user.id}">
                <img src="${user.user_image 
                    ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image 
                    : "<?= base_url('uploads/user_profile/user.png') ?>"}"
                    class="user-avatar">
                <span>${user.name ? user.name : user.email}</span>
            </a>
            `;

            usersWrapper.appendChild(div);
        }
        
        document.addEventListener("click", function (e) {

            if (!connectionStartUser) return;

            const link = e.target.closest("a");
            if (!link) return;

            // Only block anchor navigation during connection mode
            e.preventDefault();

        }, true); // capture phase


        /* ===============================
        CLOSE MENU
        =============================== */
        document.addEventListener("click", function () {
            menu.style.display = "none";
        });

        function suggestionItemTemplate(tagData) {
            return `
            <div ${this.getAttributes(tagData)}
                class="tagify__dropdown__item d-flex align-items-center"
                tabindex="0"
                role="option">

                ${tagData.avatar ? `
                <div class="tagify__dropdown__item__avatar-wrap me-2">
                    <img class="rounded-circle"
                        src="${tagData.avatar}"
                        style="width:28px;height:28px"
                        onerror="this.style.display='none'">
                </div>` : ''}

                <div>
                    <div class="fw-bold">${tagData.name || 'Unknown User'}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
            `;
        }
        
        function renderUsersOnTimelines(users) {

            users.forEach(user => {
                renderUserOnTimeline(user, user.timeline_id);
            });
        }


        $('#tree_select').on('change', function () {

            resetConnectionMode();

            treeId = $(this).val(); // 🔥 update global treeId

            connections = [];

            // 2. 🔥 CLEAR OLD SVG LINES (DOM)
            document.getElementById("connectionLayer").innerHTML = '';

            if (!treeId) {
                timelineContainer.innerText = 'No Tree Selected';
                return;
            }
            
            $.ajax({
                url: '<?= base_url('home/get_branches')?>',
                type: 'POST',
                datatype: 'json',
                data:{
                    tree_id: treeId
                },
                success: (res)=>{
                    json = JSON.parse(res);
                    renderTimeLineNew(json.branches);
                    renderUsersOnTimelines(json.users);
                    loadConnections(treeId)
                },
                error: (e)=>{
                    console.log(e);

                }

            })
        })

        $('#tree_select').trigger('change');

        document.addEventListener("contextmenu", function (e) {

            // Disable menu if connecting users
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            const userEl = e.target.closest(".timeline-user");
            if (!userEl) return;

            e.preventDefault();
            e.stopPropagation();

            activeUser = userEl;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            // Mouse position relative to wrapper
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = userMenu.offsetWidth;
            const menuHeight = userMenu.offsetHeight;

            if (x + menuWidth > rect.width) {
                x = rect.width - menuWidth - 5;
            }

            if (y + menuHeight > rect.height) {
                y = rect.height - menuHeight - 5;
            }

            userMenu.style.position = "absolute";
            userMenu.style.left = x + "px";
            userMenu.style.top = y + "px";
            userMenu.style.display = "block";
        });


        menuRemoveUser.addEventListener("click", function () {

            if (!activeUser) return;

            const userId = activeUser.dataset.userId;
            const timelineId = activeUser.dataset.timelineId;

            if (!confirm("Are you sure you want to remove this user?")) {
                return;
            }

            $.ajax({
                url: "<?= base_url('Home/remove_user_from_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    timeline_id: timelineId,
                    user_id: userId
                },
                success: function (res) {

                    if (res.status === 'success') {
                        activeUser.remove(); // 🔥 UI update
                    }
                }
            });

            userMenu.style.display = "none";
        });

        document.addEventListener("click", function () {
            userMenu.style.display = "none";
        });

        document.addEventListener("dragstart", function (e) {

            const user = e.target.closest(".timeline-user");
            if (!user) return;

            draggedUser = user;
            e.dataTransfer.effectAllowed = "move";
            user.classList.add("dragging");
        });

        document.addEventListener("dragend", function (e) {
            if (draggedUser) {
                draggedUser.classList.remove("dragging");
                requestAnimationFrame(() => {
                    updateAllLines();
                });
                draggedUser = null;
            }
        });

        function updateLinesForUser(userEl) {
            // Loop through all existing connections
            connections.forEach(conn => {
                // If this connection involves the moved user, update coordinates
                if (conn.from === userEl || conn.to === userEl) {
                    updateLinePosition(conn);
                }
            });
        }

        document.addEventListener("dragover", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper) return;

            e.preventDefault();

            if (draggedUser) {
                updateLinesForUser(draggedUser);
            }
        });

        document.addEventListener("drop", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper || !draggedUser) return;

            e.preventDefault();

            const timeline = usersWrapper.closest(".my_timeline");
            if (!timeline) return;

            const oldTimelineId = draggedUser.dataset.timelineId;
            const newTimelineId = timeline.dataset.id;

            // 🔥 Append to wrapper (move user)
            usersWrapper.appendChild(draggedUser);

            // 🔥 Update dataset
            draggedUser.dataset.timelineId = newTimelineId;

            requestAnimationFrame(() => {
                updateAllLines(); // Better than just updating the single user
            });

            // 🔥 Save change in DB
            updateUserTimeline(
                draggedUser.dataset.userId,
                oldTimelineId,
                newTimelineId
            );
        });

        function updateUserTimeline(userId, oldTimelineId, newTimelineId) {

            $.ajax({
                url: "<?= base_url('Home/update_user_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    user_id: userId,
                    from_timeline: oldTimelineId,
                    to_timeline: newTimelineId
                },
                success: function (res) {
                    console.log("User moved");
                }
            });
        }
        
        const menuAddConnection = document.getElementById("menuAddConnection");

        menuAddConnection.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeUser) return;

            connectionStartUser = activeUser;

            activeUser.classList.add("connection-source");

            userMenu.style.display = "none";
            menu.style.display = "none";

            // alert("Now click on another user to connect");
        });
        
        document.addEventListener("click", function (e) {

            // If we are NOT in connection mode, do nothing
            if (!connectionStartUser) return;

            const targetUser = e.target.closest(".timeline-user");

            // If clicked on empty space (and not the menu), cancel mode
            if (!targetUser) {
                // We add a small check to ensure we didn't just click the menu 
                // (Double safety, though e.stopPropagation in step 1 handles this)
                if(!e.target.closest('#menuAddConnection')){
                    console.log("Clicked outside, resetting mode");
                    resetConnectionMode();
                }
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            // Prevent connecting to self
            if (targetUser === connectionStartUser) {
                console.log("Cannot connect to self");
                resetConnectionMode();
                return;
            }

            // 🔥 Create connection
            createConnection(connectionStartUser, targetUser);

            resetConnectionMode();
        });


        
        function createConnection(userA, userB) {

            if (connectionExists(userA, userB)) return;

            const svg = document.getElementById("connectionLayer");

            const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

            line.setAttribute("stroke", "#0d6efd");
            line.setAttribute("stroke-width", "2");
            line.setAttribute("data-from", userA.dataset.userId);
            line.setAttribute("data-to", userB.dataset.userId);

            svg.appendChild(line);

            const connection = { from: userA, to: userB, line };
            connections.push(connection);

            updateLinePosition(connection);

            // 🔥 Save to DB (optional)
            saveConnection(userA.dataset.userId, userB.dataset.userId);
        }
        
        function updateLinePosition(connection) {
            // 🔥 FIX: Select the image specifically, not the whole div
            const imgA = connection.from.querySelector('.user-avatar');
            const imgB = connection.to.querySelector('.user-avatar');

            // Get rect of the Image (if image is missing, fall back to the div)
            const rectA = (imgA || connection.from).getBoundingClientRect();
            const rectB = (imgB || connection.to).getBoundingClientRect();
            
            const svgRect = document.getElementById("connectionLayer").getBoundingClientRect();

            // Calculate center based on the IMAGE dimensions
            const x1 = rectA.left + rectA.width / 2 - svgRect.left;
            const y1 = rectA.top + rectA.height / 2 - svgRect.top;

            const x2 = rectB.left + rectB.width / 2 - svgRect.left;
            const y2 = rectB.top + rectB.height / 2 - svgRect.top;

            connection.line.setAttribute("x1", x1);
            connection.line.setAttribute("y1", y1);
            connection.line.setAttribute("x2", x2);
            connection.line.setAttribute("y2", y2);
        }

        function saveConnection(fromUser, toUser) {
            $.post("<?= base_url('Home/save_connection') ?>", {
                tree_id: treeId,
                from_user: fromUser,
                to_user: toUser
            });
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        });

        function resetConnectionMode() {
            if (connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        }

        function loadConnections(treeId) {
            $.get("<?= base_url('Home/get_connections') ?>", { tree_id: treeId }, function (res) {
                // Ensure res is an object if jQuery didn't parse it automatically
                if (typeof res === 'string') res = JSON.parse(res); 

                if (!res.success) return;

                res.connections.forEach(conn => {
                    // 🔥 Select by the attribute directly to be safe
                    const userA = document.querySelector(
                        `.timeline-user[data-user-id="${conn.from_user}"]`
                    );
                    const userB = document.querySelector(
                        `.timeline-user[data-user-id="${conn.to_user}"]`
                    );

                    // Debugging check
                    // console.log(`Connecting ${conn.from_user} to ${conn.to_user}`, userA, userB);

                    if (userA && userB) {
                        createConnection(userA, userB);
                    }
                });
            }, "json");
        }
        
        function connectionExists(a, b) {
            return connections.some(c =>
                (c.from === a && c.to === b) ||
                (c.from === b && c.to === a)
            );
        }

        function updateAllLines() {
            connections.forEach(conn => {
                updateLinePosition(conn);
            });
        }
        

        function updateAllConnections() {
            connections.forEach(connection => {
                updateLinePosition(connection);
            });
        }

        const artificialFamilyTab = document.getElementById('view-artificial-family-tab');

        artificialFamilyTab.addEventListener('shown.bs.tab', function (event) {
            console.log('Artificial Family tab activated');

            // 🔥 Run ONLY for this tab
            updateAllConnections();
        });
    });
                                                            
</script>

<script>

    $(document).on('click', '.event-item', function (e) {
        const $event_item = $(this);
        console.log('clicked event data: ', $event_item.data())
        const timelineId = $event_item.data('timelineId');
        window.location.href = `<?=base_url('calendar/data-feeding-panel')?>?id=${timelineId}`
    })
</script>

<script>
    $('#timeForm').on('submit', function (e) {

        const opening = $('#openingTime').val();
        const closing = $('#closingTime').val();

        // if (!opening || !closing) {
        //     e.preventDefault();
        //     alert('Please select opening and closing time first');
        //     return;
        // }

        // If #modalDateName is a span/div
        let dateText = $('#modalDateName').text().trim();  
        console.log('Raw date:', dateText);

        const d = new Date(dateText);

        if (isNaN(d.getTime())) {
            e.preventDefault();
            alert('Invalid date selected!');
            return;
        }

        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');

        const formatted = `${yyyy}-${mm}-${dd}`;

        $('#date_input').val(formatted);

        console.log('Formatted date:', formatted);
    });
</script>

<script>
    $(document).on('click', '#monthly_calendar_modal_btn', function () {
        $('#monthlyDownloadModal').fadeIn(200);
    });

    $(document).on('click', '#closeMonthlyDownloadModal', function (e) {
        if (e.target.id === 'closeMonthlyDownloadModal') {
            $('#monthlyDownloadModal').fadeOut(200);
        }
    });

</script>


<script>
    $(document).on('change', '#toggle_day_public', function () {
        $('#label_day_public').text(this.checked ? 'Yes' : 'No');
    });

    $(document).on('change', '#toggle_month_public', function () {
        $('#label_month_public').text(this.checked ? 'Yes' : 'No');
    });

    $(document).on('change', '#toggle_year_public', function () {
        $('#label_year_public').text(this.checked ? 'Yes' : 'No');
    });

    $('#save_calendar_permission_btn').on('click', function () {

        let payload = [];

        // DAY
        if ($('#artificial_day').val()) {
            payload.push({
                scope: 'day',
                date: $('#artificial_day').val(),
                permission_type: $('#day_permission_type').val(),
                is_public: $('#toggle_day_public').is(':checked') ? 1 : 0
            });
        }

        // MONTH
        if ($('#artificial_month').val()) {
            payload.push({
                scope: 'month',
                month: $('#artificial_month').val(),
                permission_type: $('#month_permission_type').val(),
                is_public: $('#toggle_month_public').is(':checked') ? 1 : 0
            });
        }

        // YEAR
        if ($('#artificial_year').val()) {
            payload.push({
                scope: 'year',
                year: $('#artificial_year').val(),
                permission_type: $('#year_permission_type').val(),
                is_public: $('#toggle_year_public').is(':checked') ? 1 : 0
            });
        }

        if (payload.length === 0) {
            alert('Please select at least one date/month/year');
            return;
        }
        
        let base_url = "<?= base_url() ?>"

        $.ajax({
            url: base_url + 'Calendar/saveCalendarPermissions',
            type: 'POST',
            data: JSON.stringify(payload),
            contentType: 'application/json',
            success: function (res) {
                alert('Permissions saved successfully');
                $('#calendarPermissionModal').modal('hide');
            },
            error: function (err) {
                console.log(err);
                alert('Something went wrong');
            }
        });

    });

    $('#openPermissionsModal').on('click', function () {

        const modal = new bootstrap.Modal(document.getElementById('permissionsModal'));
        modal.show();

        $('#permissionsLoader').removeClass('d-none');
        $('#permissionsTableBody').html('');

        $.ajax({
            url: '<?= site_url("calendar/getPermissions"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (res) {

                $('#permissionsLoader').addClass('d-none');

                if (!res || res.length === 0) {
                    $('#permissionsTableBody').html(`
                        <tr>
                            <td colspan="5" class="text-center">No permissions found</td>
                        </tr>
                    `);
                    return;
                }

                let rows = '';

                res.forEach(function (perm) {

                    let reference = '-';

                    if (perm.permission_scope === 'day') {
                        reference = perm.reference_date;
                    }

                    if (perm.permission_scope === 'month') {
                        reference = perm.reference_month;
                    }

                    if (perm.permission_scope === 'year') {
                        reference = perm.reference_year;
                    }

                    rows += `
                        <tr>
                            <td>${perm.permission_scope}</td>
                            <td>${reference}</td>
                            <td>${perm.permission_type}</td>
                            <td>${perm.is_public == 1 ? 'Yes' : 'No'}</td>
                            <td>${perm.created_at}</td>
                            <td><a href="<?= base_url('calendar/index_public?id=') ?>${perm.id}">view</a></td>
                        </tr>
                    `;
                });

                $('#permissionsTableBody').html(rows);
            },
            error: function (err) {
                $('#permissionsLoader').addClass('d-none');
                console.error(err);
                alert('Failed to load permissions');
            }
        });

    });
</script>

<script>
    let selectedCompanyId = null;

    $(document).on('change', '#selected_company', function () {
        selectedCompanyId = $('#selected_company').val();
        selectedCompanyName = $('#selected_company').find('option:selected').text()
    })

    $(document).on('click', '#search_project_btn', function () {
        if(!selectedCompanyId){
            alert('select company first');
            return;

        }
        selectedCompanyId = $('#selected_company').val();
        selectedCompanyName = $('#selected_company').find('option:selected').text();
        
        $.ajax({
            url: '<?= base_url('Teams/get_projects') ?>',
            type: 'POST',
            data: {
                selectedCompanyId: selectedCompanyId
            },
            dataType: 'json',
            success: function (res) {
                $('#projects_container').empty();
                $('#projects_container').append(res.html);
                $('#search_bricks_btn').hide();
            },
            error: function (res) {
                console.error(res)
            }
        })
    })

    // $("#save_calendar_appointment_btn").on("click", function () {

    //     let company_id = $("#selected_company").val();
    //     let project_id = $("#selected_project").val(); // if radio
    //     let start = $("input[name='appointment_start_date_time']").val();
    //     let end = $("input[name='appointment_end_date_time']").val();
    //     let notes = $("textarea[name='notes']").val();
    //     let bid_cur = $("select[name='currency_symbol']").val();
    //     let bid_amount = $("input[name='bid_amount']").val();
    //     let barter_bid = $("textarea[name='barter_bid']").val();

    //     if (!company_id || !start || !end) {
    //         alert("All fields are required!");
    //         return;
    //     }

    //     $.ajax({
    //         url: "<?= base_url('appointment/store') ?>",
    //         type: "POST",
    //         data: {
    //             company_id: company_id,
    //             project_id: project_id,
    //             start_datetime: start,
    //             end_datetime: end,
    //             notes: notes,
    //             bid_cur: bid_cur,
    //             bid_amount: bid_amount,
    //             barter_bid: barter_bid
    //         },
    //         dataType: "json",
    //         success: function (response) {

    //             if (response.success) {
    //                 alert("Appointment Booked Successfully!");
    //                 $("#appointmentModal").modal("hide");
    //             } else {
    //                 alert(response.message);
    //             }
    //         }
    //     });

    // });
    $("#save_calendar_appointment_btn").on("click", function () {

        let company_id = $("#selected_company").val();
        let project_id = $("#selected_project").val();
        let start = $("input[name='appointment_start_date_time']").val();
        let end = $("input[name='appointment_end_date_time']").val();
        let notes = $("textarea[name='notes']").val();
        let bid_cur = $("select[name='currency_symbol']").val();
        let bid_amount = $("input[name='bid_amount']").val();
        let barter_bid = $("textarea[name='barter_bid']").val();

        let booking_type = $("#user_booking_section").is(":visible") ? "user" : "company";

        let selected_users = [];

        // GET TAGIFY USERS
        if (booking_type === "user") {

            let tagifyValue = $("#team-member-input").val();

            if (tagifyValue) {

                let parsed = JSON.parse(tagifyValue);

                parsed.forEach(function (u) {
                    selected_users.push(u.value); // user id
                });

            }

            if (selected_users.length === 0) {
                alert("Please select at least one user");
                return;
            }

        } else {

            if (!company_id) {
                alert("Please select company");
                return;
            }

        }

        if (!start || !end) {
            alert("Start and End date required");
            return;
        }

        $.ajax({
            url: "<?= base_url('appointment/store') ?>",
            type: "POST",
            data: {

                booking_type: booking_type,

                company_id: company_id,
                project_id: project_id,

                users: selected_users,

                start_datetime: start,
                end_datetime: end,
                notes: notes,

                bid_cur: bid_cur,
                bid_amount: bid_amount,
                barter_bid: barter_bid

            },
            dataType: "json",

            success: function (response) {

                if (response.success) {

                    alert("Appointment Booked Successfully!");

                    $("#appointmentModal").modal("hide");

                    $("#appointmentForm")[0].reset();

                } else {

                    alert(response.message);

                }

            }

        });

    });
</script>

<script>
    $('#bookingTypeSwitch').on('change', function () {

        if ($(this).is(':checked')) {

            // USER BOOKING
            $('#company_booking_section').hide();
            $('#user_booking_section').show();

        } else {

            // COMPANY BOOKING
            $('#company_booking_section').show();
            $('#user_booking_section').hide();

        }

    });

    var inputElm = document.querySelector('#team-member-input');

    function tagTemplate(tagData) {
        return `
        <tag title="${tagData.email || ''}" 
                contenteditable='false' 
                spellcheck='false' 
                tabIndex="-1" 
                class="tagify__tag" 
                value="${tagData.value}">
            <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
            <div class="d-flex align-items-center">
                <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                        class="rounded-circle me-2" 
                        style="width: 24px; height: 24px;">
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        </tag>
    `;
    }

    function suggestionItemTemplate(tagData) {
        return `
        <div ${this.getAttributes(tagData)}
            class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
            tabindex="0"
            role="option">
            ${ tagData.avatar ? `
            <div class='tagify__dropdown__item__avatar-wrap'>
                <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
            </div>` : ''
            }
            <div>
                <div class="fw-bold">${tagData.label || tagData.value}</div>
                <small class="text-muted">${tagData.email || ''}</small>
            </div>
        </div>
    `;
    }

    function dropdownHeaderTemplate(suggestions) {
        return `
        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
            <span>${suggestions.length} members</span>
        </div>
    `;
    }

    // INISILIZE USER SEARCH
    var tagify = new Tagify(inputElm, {
        tagTextProp: 'name',
        enforceWhitelist: true,
        skipInvalid: true,
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name', 'email']
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate,
            dropdownHeader: dropdownHeaderTemplate
        },
        whitelist: []
    });

    tagify.on('input', function(e) {
        var value = e.detail.value.trim();
        tagify.loading(true);

        fetch('<?php echo base_url('Home/searchUsers'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    search: value
                })
            })
            .then(response => response.json())
            .then(data => {
                tagify.loading(false);
                if (data.success && Array.isArray(data.users)) {
                    tagify.settings.whitelist = data.users.map(user => ({
                        value: user.id,
                        name: user.name,
                        label: user.name,
                        email: user.email,
                        avatar: user.avatar || 'assets/user-icon.png'
                    }));
                    tagify.dropdown.show(value);
                } else {
                    tagify.settings.whitelist = [];
                    tagify.dropdown.hide();
                    alert('No users found or invalid response from server.');
                }
            })
            .catch(error => {
                tagify.loading(false);
                console.error('Error searching users:', error);
                alert('Failed to search users: ' + error.message);
            });
    });
</script>
<!-- Shiv Web Developer -->