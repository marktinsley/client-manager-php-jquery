export class Listing {
    constructor() {
        this.listContainer = $('.clients-list-container')
        this.loading = this.listContainer.find('.loading')
        this.list = this.listContainer.find('.list')
        this.filterContainer = this.listContainer.find('.filter-container')
        this.notFoundMessage = this.listContainer.find('.not-found-message')
    }

    run() {
        this.setBinding()
        this.fetchClients()
    }

    setLoading() {
        this.loading.show()
        this.filterContainer.hide();
        this.notFoundMessage.hide()
        this.list.hide()
    }

    setNotLoading(haveClients) {
        this.loading.hide()
        this.filterContainer.show();

        if (haveClients) {
            this.list.show()
        } else {
            this.notFoundMessage.show()
        }
    }

    fetchClients() {
        this.setLoading()
        this.clearListing()

        jQuery
            .ajax({
                url: '/api/clients',
                data: {
                    'id': this.filterContainer.find('input.id').val(),
                    'name': this.filterContainer.find('input.name').val()
                }
            })
            .done(paginator => {
                this.populateListing(paginator)
                this.setNotLoading(paginator.total > 0)
            });
    }

    clearListing() {
        this.list.find('tbody').empty()
    }

    populateListing(paginator) {
        let tbody = this.list.find('tbody')

        paginator.data.forEach(client => {
            let tr = $('<tr>')
            tr.append($('<td>' + client.id + '</td>'))
            tr.append($('<td>' + client.first_name + ' ' + client.last_name + '</td>'))
            tr.append($('<td>' + client.email + '</td>'))
            tr.append($('<td>' + client.phone + '</td>'))

            tbody.append(tr)
        })
    }

    setBinding() {
        this.filterContainer.find('form').on('submit', () => {
            this.fetchClients()
            return false
        })
    }
}