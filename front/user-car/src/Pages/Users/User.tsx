
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const User = () => {
    const { isLoading, error, data } = useQuery('user', async () => {
        const response = await api.get('/user/1' );
        return response.data;
    })

    return (
        <div>
            <h1> User </h1>
            <pre> { JSON.stringify(data, null, 2) } </pre>
        </div>
    )
}

export default User;