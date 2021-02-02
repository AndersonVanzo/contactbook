import TodosContatos from './components/TodosContatos';
import NovoContato from './components/NovoContato';
import EditarContato from './components/EditarContato';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: TodosContatos
    },
    {
        name: 'create',
        path: '/create',
        component: NovoContato
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditarContato
    }
];