webpackJsonp([1],{

/***/ 36:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(37);


/***/ }),

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

var ClassicEditor = __webpack_require__(39);

var editor = document.querySelector('.ckeditor');

if (editor) {
    ClassicEditor.create(editor, {
        toolbar: ['bold', 'italic']
    }).catch(function (error) {
        console.error(error);
    });
}

/***/ })

},[36]);