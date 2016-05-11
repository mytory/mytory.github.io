window.ParsleyConfig = window.ParsleyConfig || {};

(function ($) {
  window.ParsleyConfig = $.extend( true, {}, window.ParsleyConfig, {
    messages: {
      // parsley //////////////////////////////////////
        defaultMessage: "값이 잘못 입력됐습니다."
        , type: {
            email:      "이메일을 올바로 입력해 주세요."
          , url:        "URL을 올바로 입력해 주세요."
          , urlstrict:  "URL을 올바로 입력해 주세요."
          , number:     "숫자만 입력 가능합니다."
          , digits:     "숫자만 입력 가능합니다."
          , dateIso:    "날짜 형식을 올바로 입력해 주세요.(예 - 2000-12-31)"
          , alphanum:   "알파벳과 숫자만 입력할 수 있습니다."
          , phone:      "전화번호를 올바로 입력해 주세요."
        }
      , notnull:        "값이 null이 될 수 없습니다."
      , notblank:       "비어 있으면 안 됩니다."
      , required:       "필수 입력값입니다."
      , regexp:         "값이 잘못 입력됐습니다."
      , min:            "최소한 %s 이상이어야 합니다.."
      , max:            "%s 넘게 입력할 수 없습니다."
      , range:          "최소 %s, 최대 %s입니다."
      , minlength:      "너무 짧습니다. %s글자 이상이어야 합니다."
      , maxlength:      "너무 깁니다. %s글자를 넘으면 안 됩니다."
      , rangelength:    "최소 %s글자 이상, 최대 %s글자여야 합니다."
      , mincheck:       "최소 %s개를 선택하셔야 합니다."
      , maxcheck:       "최대 %s개를 선택할 수 있습니다."
      , rangecheck:     "%s개에서 %s개 사이를 선택해 주셔야 합니다."
      , equalto:        "값이 서로 다릅니다."

      // parsley.extend ///////////////////////////////
      , minwords:       "최소 %s단어여야 합니다."
      , maxwords:       "최대 %s단어를 넘을 수 없습니다."
      , rangewords:     "최소 %s단어, 최대 %s단어입니다."
      , greaterthan:    "%s보다 커야 합니다."
      , lessthan:       "%s보다 작아야 합니다."
      , beforedate:     "날짜가 %s 이전이어야 합니다."
      , afterdate:      "날짜가 %s 이후여야 합니다."
      , americandate:	"날짜 형식을 올바로 입력해 주세요.(예 - 12/31/2000)"
    }
  });
}(window.jQuery || window.Zepto));