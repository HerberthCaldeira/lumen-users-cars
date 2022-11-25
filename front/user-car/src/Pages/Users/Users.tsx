
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const Users = () => {
    const { isLoading, error, data } = useQuery('users', async () => {
        const response = await api.get('/users');
        return response.data;
    })

    return (
        <div>
            <h1>Users</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default Users;