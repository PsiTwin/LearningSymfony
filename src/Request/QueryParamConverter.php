<?php

namespace App\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class QueryParamConverter implements ParamConverterInterface
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param ParamConverter $configuration
     * @return bool
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        foreach ($request->query->all() as $key => $param){
            if ($param === "true") {
                $request->query->set($key, true);
            } elseif ($param === "false") {
                $request->query->set($key, false);
            }
        }
        $data = $this->serializer->deserialize(json_encode($request->query->all()), $configuration->getClass(), 'json');
        $request->attributes->set($configuration->getName(), $data);
        return true;
    }

    /**
     * @param ParamConverter $configuration
     * @return bool
     */
    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getConverter() === "query_converter";
    }
}