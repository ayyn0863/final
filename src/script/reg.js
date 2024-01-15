/* ===== Logic for creating fake Select Boxes ===== */
$('.sel').each(function() {
  $(this).children('select').css('display', 'none');
  
  var $current = $(this);
  
  $(this).find('option').each(function(i) {
    if (i == 0) {
      $current.prepend($('<div>', {
        class: $current.attr('class').replace(/sel/g, 'sel__box')
      }));
      
      var placeholder = $(this).text();
      $current.prepend($('<span>', {
        class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
        text: placeholder,
        'data-placeholder': placeholder
      }));
      
      return;
    }
    
    $current.children('div').append($('<span>', {
      class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
      text: $(this).text()
    }));
  });
});

// Toggling the `.active` state on the `.sel`.
$('.sel').click(function() {
  $(this).toggleClass('active');
});

// Toggling the `.selected` state on the options.
$('.sel__box__options').click(function() {
  var txt = $(this).text();
  var index = $(this).index();
  
  $(this).siblings('.sel__box__options').removeClass('selected');
  $(this).addClass('selected');
  
  var $currentSel = $(this).closest('.sel');
  $currentSel.children('.sel__placeholder').text(txt);
  $currentSel.children('select').prop('selectedIndex', index + 1);
});

new Vue({
  el: '#appForm',
  data: {
    name: '',
    hinsyu: '', // hinsyuのデータプロパティを追加
    text: '',
    NameError: false,
    HinsyuError: false, // HinsyuErrorプロパティの名前を修正
    TextError: false
  },
  methods: {
    validateForm: function () {
      this.NameError = this.name.trim() === '';
      this.HinsyuError = this.hinsyu.trim() === '' || this.hinsyu === null; // hinsyuが選択されているか確認
      this.TextError = this.text.trim() === '';

      // エラーがある場合はtrueを返す
      return this.NameError || this.HinsyuError || this.TextError;
    },
    submitForm: function () {
      if (!this.validateForm()) {
        // バリデーションが通過した場合、フォームを送信
        document.getElementById('appForm').submit();
      }
    }
  },
  watch: {
    name: function () {
      if (this.name.trim() !== '') {
        this.NameError = false; // エラーがない場合、エラーメッセージをクリア
      }
    },
    hinsyu: function () {
      if (this.hinsyu !== null && this.hinsyu.trim() !== '') {
        this.HinsyuError = false; // エラーがない場合、エラーメッセージをクリア
      }
    },
    text: function () {
      if (this.text.trim() !== '') {
        this.TextError = false; // エラーがない場合、エラーメッセージをクリア
      }
    }
  }
});