
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const UserEdit = () => {
    const { isLoading, error, data } = useQuery('user_edit', async () => {
        const newData = {
            email: Math.random().toString() + '@test.com',
            password: 'teste123465' + Math.random().toString()
        }
        const response = await api.put('/user/1', newData);
        return response.data;
    })

    return (
        <div>
            <h1>User edit</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default UserEdit;