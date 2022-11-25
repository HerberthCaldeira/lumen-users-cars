
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const UserDelete = () => {
    const { isLoading, error, data } = useQuery('user_delete', async () => {
        const response = await api.delete('/user/1');
        return response.data;
    })

    return (
        <div>
            <h1>User delete</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default UserDelete;