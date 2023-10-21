<!-- CALENDARIO -->
<style>
    .img_calendar {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .img_calendar {
        page-break-inside: avoid;
        background-image: url(dist/img/calendar_bg.jpg);
    }

    .elegant-calencar {
        max-width: 2000px;
        text-align: center;
        position: relative;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 5px;
      
    }

    .wrap-header {
        position: relative;
        width: 25%;
        z-index: 0;
    }

    .wrap-header:after {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        content: '';
        background: #000;
        opacity: .5;
        z-index: -1;
    }

    @media (max-width: 767.98px) {
        .wrap-header {
            width: 100%;
            padding: 20px 0;
        }
    }

    #header_calendar {
        width: 100%;
        position: relative;
    }

    #header_calendar .pre-button,
    .header_calendar .next-button {
        cursor: pointer;
        width: 1em;
        height: 1em;
        line-height: 1em;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 18px;
    }

    .header_calendar .pre-button i,
    .header_calendar .next-button i {
        color: #fff;
    }

    .pre-button {
        left: 5px;
    }

    .next-button {
        right: 5px;
    }

    .button-wrap {
        position: relative;
        padding: 10px 0;
    }

    .button-wrap .pre-button,
    .button-wrap .next-button {
        cursor: pointer;
        width: 1em;
        height: 1em;
        line-height: 1em;
        border-radius: 50%;
        position: absolute;
        top: 0;
        font-size: 18px;
    }

    .button-wrap .pre-button i,
    .button-wrap .next-button i {
        color: #cccccc;
    }

    .button-wrap .pre-button {
        left: 20px;
    }

    .button-wrap .next-button {
        right: 20px;
    }

    .head-day {
        font-size: 9em;
        line-height: 1;
        color: #fff;
    }

    .head-month {
        font-size: 2em;
        line-height: 1;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 300;
    }

    .calendar-wrap {
        width: 75%;
        background: #fff;
        padding: 40px 20px 20px 20px;
    }

    @media (max-width: 767.98px) {
        .calendar-wrap {
            width: 100%;
        }
    }

    #calendar {
        width: 100%;
    }

    #calendar tr {
        height: 3em;
    }

    .thead_calendar tr {
        color: #000;
        font-weight: 700;
    }

    .tbody_calendar tr {
        color: #000;
    }

    .tbody_calendar td {
        width: 14%;
        border-radius: 50%;
        cursor: pointer;
        -webkit-transition: all 0.2s ease-in;
        -o-transition: all 0.2s ease-in;
        transition: all 0.2s ease-in;
        position: relative;
        z-index: 0;
    }

    .tbody_calendar td:after {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        bottom: 0;
        content: '';
        width: 44px;
        height: 44px;
        margin: 0 auto;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        border-radius: 50%;
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        z-index: -1;
    }

    @media (prefers-reduced-motion: reduce) {
        .tbody_calendar td:after {
            -webkit-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    .tbody_calendar td:hover,
    .selected {
        color: #fff;
        border: none;
    }

    .tbody_calendar td:hover:after,
    .selected:after {
        background: #2a3246;
    }

    .tbody_calendar td:active {
        -webkit-transform: scale(0.7);
        -ms-transform: scale(0.7);
        transform: scale(0.7);
    }

    #today {
        color: #fff;
    }

    #today:after {
        background: #e13a9d;
    }

    #disabled {
        cursor: default;
        background: #fff;
    }

    #disabled:hover {
        background: #fff;
        color: #c9c9c9;
    }

    #disabled:hover:after {
        background: transparent;
    }

    #reset {
        display: block;
        position: absolute;
        right: 0.5em;
        top: 0.5em;
        z-index: 999;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 0 0.5em;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 4px;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 11px;
    }

    #reset:hover {
        color: #fff;
        border-color: #fff;
    }

    #reset:active {
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
    }

    .custom-citas {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
    }

    .custom-citas-title {
        font-size: 24px;
        color: #333;
        text-transform: uppercase;
    }

    .custom-citas-container {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        margin-top: 20px;
    }
</style>

<!-- CALENDARIO -->
<div>
    <div class="elegant-calencar d-md-flex">
        <div class="wrap-header d-flex align-items-center img_calendar">
            <p id="reset">Hoy</p>
            <div id="header_calendar" class="p-0">

                <div class="head-info">
                    <div class="head-month"></div>
                    <div class="head-day"></div>
                </div>

            </div>
        </div>
        <div class="calendar-wrap">
            <div class="w-100 button-wrap">
                <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
            </div>
            <table id="calendar">
                <thead class="thead_calendar">
                    <tr>
                        <th>Dom</th>
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mie</th>
                        <th>Jue</th>
                        <th>Vie</th>
                        <th>Sab</th>
                    </tr>
                </thead>
                <tbody class="tbody_calendar">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div> <!-- FIN DEL CALENDARIO -->