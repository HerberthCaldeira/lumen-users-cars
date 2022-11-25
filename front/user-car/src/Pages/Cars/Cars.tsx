
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const Cars = () => {
    const { isLoading, error, data } = useQuery('cars', async () => {
        const response = await api.get('/cars');
        return response.data;
    })

    return (
        <div>
            <h1>cars</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default Cars;