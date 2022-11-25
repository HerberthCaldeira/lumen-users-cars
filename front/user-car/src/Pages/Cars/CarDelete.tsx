
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const CarDelete = () => {
    const { isLoading, error, data } = useQuery('car_delete', async () => {
        const response = await api.delete('/car/1');
        return response.data;
    })

    return (
        <div>
            <h1>car delete</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default CarDelete;