
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const CarEdit = () => {
    const { isLoading, error, data } = useQuery('car_edit', async () => {
        const newData = {
            model: Math.random().toString() + 'new model',
        }
        const response = await api.put('/car/1', newData);
        return response.data;
    })

    return (
        <div>
            <h1>Car edit</h1>
            <pre>{ JSON.stringify(data, null, 2) }</pre>
        </div>
    )
}

export default CarEdit;