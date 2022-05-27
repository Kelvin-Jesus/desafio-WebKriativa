window.addEventListener('DOMContentLoaded', () => {

    const modal = document.querySelector('.modal-bg')
    const tabela = document.querySelector('table')

    if (tabela) {

        tabela.addEventListener('click', ({ target }) => {
            let ehBtnExcluir = target.classList.contains('btn-excluir')
            if ( !ehBtnExcluir ) return;
            mostrarModal()
            modal.addEventListener('click', handleModal)
        
            modal.querySelector('form').setAttribute('action', target.getAttribute('data-url'))
            modal.querySelector('.btn-excluir').addEventListener('click', esconderModal);

        })

    }

    const handleModal = ({ target }) => {
        if (target.classList.contains('modal-bg')) {
            console.log(target.classList)
            esconderModal()
            return;
        }
    }

    const mostrarModal = () => {
        modal.classList.remove('hide')
        modal.classList.add('show')
    }

    const esconderModal = () => {
        modal.classList.add('transition')
        setTimeout(() => {
            modal.classList.remove('show')
            modal.classList.add('hide')
            modal.classList.remove('transition')
        }, 250)
    }

})