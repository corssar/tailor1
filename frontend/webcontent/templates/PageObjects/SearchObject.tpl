<div id="search_block">
    <div class="search">
        <form id="search_form" action="{$action}" method="get" class="search-block">
            <input type="submit" style="display: none;" value=""/>
            <a href="#" class="search-button" onclick="searchSubmit(); return false;">
                <span class="icon_search" style="margin-top: 0px; margin-left: 0px; position: relative;">
                    <svg height="15" version="1.1" width="16" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: 15.5px; top: 6.5px;">
                        <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Rapha?l 2.1.0</desc>
                        <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                        <path fill="#ffffff" stroke="none" d="M29.772,26.433L22.645999999999997,19.307C23.605999999999998,17.724,24.168999999999997,15.871999999999998,24.169999999999998,13.886C24.169,8.093,19.478,3.401,13.688,3.399C7.897,3.401,3.204,8.093,3.204,13.885C3.204,19.674,7.897,24.366,13.688,24.366C15.675,24.366,17.527,23.803,19.11,22.843L26.238,29.97L29.772,26.433ZM7.203,13.885C7.2090000000000005,10.303,10.106,7.407,13.687000000000001,7.399C17.266000000000002,7.407,20.165,10.303,20.171,13.885C20.163999999999998,17.465,17.266,20.361,13.687,20.369C10.106,20.361,7.209,17.465,7.203,13.885Z" transform="matrix(0.5646,0,0,0.5646,-0.7252,-1.7688)" stroke-width="1.7712" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                    </svg>
                </span>
            </a>
            <div class="frame-search-input">
                <input type="text" id="input-search" name="text" autocomplete="off" value="" placeholder="{$webtext_siteSearch}{*Поиск по сайту*}">
            </div>

        </form>
    </div>
</div>