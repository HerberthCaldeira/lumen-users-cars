
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const createCar = () => {
    const { isLoading, error, data } = useQuery('create_car', async () => {
        const newCar = {
            model: Math.random().toString() + '@test.com',
        }
        const response = await api.post('/car', newCar);
        return response.data;
    })

    return (
        <div>
            <h1>create car</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default createCar;