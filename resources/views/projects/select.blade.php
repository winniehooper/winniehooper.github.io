<div class="nb-dd-toggle-wrap js-dd-select-box">

    <div class="nb-dd-toggle js-toggle-dd">
        <span class="nb-dd-toggle-txt js-toggle-dd-txt @if(!$value)nb-dd-toggle-txt--default @endif">{{ $items[$value] }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M12.003 1L6.502 6.592 1 1" class="cls-dd-arrow-Aqua"/></svg>
    </div>

    <select class="nb-dd-default js-dd-select js-ajax-project-update-info nb-input--invalid" name="{{ $name }}" param="{{ $id }}">
        @foreach($items as $k => $v)
            <option class="js-dd-option" value="{{ $k }}" @if($k == $value) selected @endif>{{ $v }}</option>
        @endforeach
    </select>

    <ul class="nb-dd nb-dd--hidden js-dd-menu">
        @foreach($items as $k => $v)
            <li class="nb-dd-item">
                <div data-value="{{ $k }}" class="dd-item-link js-true-select-value js-dd-menu-item @if($k == $value) dd-item-link--selected @endif>{{ $v }}">{{ $v }}</div>
            </li>
        @endforeach
    </ul>
</div>