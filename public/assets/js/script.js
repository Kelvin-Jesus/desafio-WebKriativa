window.addEventListener('DOMContentLoaded', () => {

    const modal = document.querySelector('.modal-bg')
    const tabela = document.querySelector('table')
    const buscarProduto = document.querySelector('.buscar-produto')
    const buscarCliente = document.querySelector('.buscar-cliente')
    const resultadosProdutosContainer = document.querySelector('.resultados-produtos')
    const resultadosClientesContainer = document.querySelector('.resultados-clientes')
    const filtrarItens = document.querySelector('.filtrar-itens')

    if ( filtrarItens ) {
        
        filtrarItens.addEventListener('input', ({ target }) => {
    
            const tbody = document.querySelector('tbody')
            tbody.querySelectorAll('tr').forEach( elemento => {
    
                const conteudoELemento = String(elemento.textContent.toLowerCase())
                const textoPesquisado = String(target.value.toLowerCase())
    
                if ( textoPesquisado === '' ) {
                    elemento.classList.remove('d-none')
                    return;
                }
    
                if( conteudoELemento.includes(textoPesquisado) === false ) {
                    elemento.classList.add('d-none')
                    return;
                }
    
                elemento.classList.remove('d-none')
    
            })
    
        });

    }


    if (tabela) {

        tabela.addEventListener('click', ({ target }) => {
            let ehBtnExcluir = target.classList.contains('btn-excluir')
            if ( !ehBtnExcluir ) return;
            mostrarModal()
            modal.addEventListener('click', handleModal)
        
            modal.querySelector('form').setAttribute('action', target.getAttribute('data-url'))
            modal.querySelector('.btn-excluir').addEventListener('click', esconderModal);

        })

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

    }

    if ( buscarProduto && buscarCliente ) {
        
        const BASE_URL = window.location.origin;

        buscarProduto.addEventListener('input', async e => {
            
            const dados = await pegarDados('/api/buscar-produtos?produto', e.target.value);
            
            const listaDeResultados = resultadosProdutosContainer.querySelector('ul')
            limparListaDeResultados(listaDeResultados)

            if (dados.length === 0) {
                const el = criarElementoComResultados()
                el.textContent = 'Nenhum item encontrado'
                listaDeResultados.append(el)
                return;
            }

            dados.forEach((item) => {
                const el = criarElementoComResultados()
                el.textContent = item['nome_produto']
                el.setAttribute('data-produto-id', item['id_produto'])
                listaDeResultados.append(el)
            })

            const inputDeProduto = document.querySelector('.produto-cadastrar-nome')
            const inputDeIdProduto = document.querySelector('.produto-cadastrar-id')
            resultadosProdutosContainer.addEventListener('mouseup', (e) => {
                e.stopPropagation()
                e.preventDefault()
                if ( !e.target.getAttribute('data-produto-id') ) {
                    resultadosProdutosContainer.classList.add('d-none')
                    return;
                }

                inputDeProduto.value = e.target.textContent
                inputDeIdProduto.value = e.target.getAttribute('data-produto-id')
                resultadosProdutosContainer.classList.add('d-none')
            })
            resultadosProdutosContainer.classList.remove('d-none')
            
        });

        buscarCliente.addEventListener('input', async e => {

            const dados = await pegarDados('/api/buscar-clientes?cliente', e.target.value);
            
            const listaDeResultados = resultadosClientesContainer.querySelector('ul')
            limparListaDeResultados(listaDeResultados)
            
            if (dados.length === 0) {
                const el = criarElementoComResultados()
                el.textContent = 'Nenhum item encontrado'
                listaDeResultados.append(el)
                return;
            }

            dados.forEach((item) => {
                const el = criarElementoComResultados()
                el.textContent = item['nome_cliente']
                el.setAttribute('data-cliente-id', item['id_cliente'])
                listaDeResultados.append(el)
            })

            const inputDeCliente = document.querySelector('.cliente-cadastrar-nome')
            const inputDeIdCliente = document.querySelector('.cliente-cadastrar-id')
            resultadosClientesContainer.addEventListener('mouseup', (e) => {
                e.stopPropagation()
                e.preventDefault()
                if ( !e.target.getAttribute('data-cliente-id') ) {
                    resultadosClientesContainer.classList.add('d-none')
                    return;
                }

                inputDeCliente.value = e.target.textContent
                inputDeIdCliente.value = e.target.getAttribute('data-cliente-id')
                resultadosClientesContainer.classList.add('d-none')
            })
            resultadosClientesContainer.classList.remove('d-none')


        })

        const pegarDados = async (url, nome) => {
            const requisicao = await fetch(`${BASE_URL}${url}=${nome}`)
            const resposta = await requisicao.json()
            return await resposta
        }

        const criarElementoComResultados = () => {
            const li = document.createElement('li')
            return li
        }

        const limparListaDeResultados = (lista) => {
            while(lista.firstChild){
                lista.removeChild(lista.firstChild)
            }
        }

    }

})