jQuery(document).ready(function ($) {
    $('.pensee-viewer').each(function () {
        const viewer = $(this);
        const titleEl = viewer.find('.pensee-viewer-title');
        const contentEl = viewer.find('.pensee-viewer-content');
        const dateEl = viewer.find('.pensee-viewer-date');
        const prevBtn = viewer.find('.pensee-viewer-controls-previous');
        const nextBtn = viewer.find('.pensee-viewer-controls-next');
        const randBtn = viewer.find('.pensee-viewer-controls-rand');

        function updateViewer(data) {
            titleEl.html(data.title);
            contentEl.html(data.content);
            dateEl.html(data.date);
            viewer.data('post-id', data.id);
            viewer.data('prev-id', data.prev_id);
            viewer.data('next-id', data.next_id);

            // Show/hide or enable/disable prev/next buttons
            if (data.prev_id) {
                prevBtn.prop('disabled', false);
            } else {
                prevBtn.prop('disabled', true);
            }

            if (data.next_id) {
                nextBtn.prop('disabled', false);
            } else {
                nextBtn.prop('disabled', true);
            }
        }

        function fetchPenseeById(id) {
            $.post(pensees_ajax.ajax_url, {
                action: 'get_pensee_by_id',
                id: id
            }, function (response) {
                if (response && response.success !== false) {
                    updateViewer(response);
                }
            });
        }

        function fetchRandomPensee() {
            const currentId = viewer.data('post-id');
            $.post(pensees_ajax.ajax_url, {
                action: 'get_random_pensee',
                exclude_id: currentId
            }, function (response) {
                if (response && response.success !== false) {
                    updateViewer(response);
                }
            });
        }

        prevBtn.on('click', function () {
            const prevId = viewer.data('prev-id');
            if (prevId) fetchPenseeById(prevId);
        });

        nextBtn.on('click', function () {
            const nextId = viewer.data('next-id');
            if (nextId) fetchPenseeById(nextId);
        });

        randBtn.on('click', function () {
            fetchRandomPensee();
        });
    });
});
