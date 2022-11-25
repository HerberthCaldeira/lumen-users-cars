
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const UserDetachCar = () => {
    const { isLoading, error, data } = useQuery('user_detach_car', async () => {
        const response = await api.delete('/user/' + 2 + '/car/' + 2);
        return response.data;
    })

    return (
        <div>
            <h1>Users</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default UserDetachCar;