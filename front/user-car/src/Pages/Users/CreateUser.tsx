
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const CreateUser = () => {
    const { isLoading, error, data } = useQuery('create_user', async () => {
        const newUser = {
            name: 'John' +  Math.random().toString(),
            email: Math.random().toString() + '@test.com',
            password: 'teste123465'
        }
        const response = await api.post('/user', newUser);
        return response.data;
    })

    return (
        <div>
            <h1>create users</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default CreateUser;