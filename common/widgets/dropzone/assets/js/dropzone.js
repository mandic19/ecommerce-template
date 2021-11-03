let dropzone = (function ($) {
    return {
        instances: [],
        id: 1,
        initialize: function (config, options) {
            let self = {...this};
            self.id = dropzone.id++;
            self.config = config;

            let defaults = {
                sending: function (file, xhr, formData) {
                    formData.append(yii.getCsrfParam(), yii.getCsrfToken());
                },
                successmultiple: function (files, xhr) {
                    if (xhr.success !== true) {
                        return;
                    }
                    $.each(files, function (key) {
                        files[key].id = xhr.data[key].image_id;
                        self.config.items.push({
                            id: xhr.data[key].image_id
                        });
                    });
                    self.updateInput();
                },
                removedfile: function (file) {
                    self.config.items = self.config.items.filter(function (item) {
                        return item.id !== file.id;
                    });

                    $(file.previewElement).remove();
                    self.updateInput();

                    if (self.dropzone.options.maxFiles > self.config.items.length) {
                        $(self.dropzone.element).removeClass('dz-max-files-reached');
                    }

                    self.refreshMaxFiles();
                },
                maxfilesexceeded: function (file) {
                    file.previewElement.remove();
                    main.ui.notify(self.dropzone.options.dictMaxFilesExceeded, 'error');
                }
            };

            self.options = $.extend({}, defaults, options);

            self.dropzone = new Dropzone(self.config.target, self.options);

            self.initExistingItems();
            self.updateInput();
            dropzone.instances.push(self);
        },
        updateInput: function () {
            let self = this;
            let input = $(self.config.input);
            let items = self.config.items;
            let inputValue = [];

            if(input.length < 1) {
                return;
            }

            $.each(items, function (key, value) {
                inputValue.push(value.id);
            });

            input.val(JSON.stringify(inputValue));
        },
        initExistingItems: function () {
            var self = this;

            let itemCount = self.config.items.length;
            self.dropzone.options.maxFiles = self.dropzone.options.maxFiles - itemCount;

            $.each(self.config.items, function (key, file) {
                self.dropzone.files.push(file);
                self.dropzone.emit('addedfile', file);
                self.dropzone.emit('complete', file);
                self.dropzone.emit('thumbnail', file, file.url);
            });
        },
        refreshMaxFiles: function () {
            let self = this;
            let initialMaxFiles = self.dropzone.options.maxFiles + self.config.initialItems.length;
            self.config.initialItems = self.config.initialItems.filter(x => self.config.items.filter(y => y.id == x.id).length > 0);
            self.dropzone.options.maxFiles = initialMaxFiles - self.config.initialItems.length;
        }
    };
})(jQuery);


