<?php

namespace Calculator\Application;

/**
 * @author sr_hosseini
 */
interface DefaultControllerInterface extends ControllerInterface
{
    /**
     * constants provide available methods in each implementation of default controller
     */
    const NotFound = 'notFound';
    const InternalError = 'internalError';

    public function notFound(RequestInterface $request);
    public function internalError(RequestInterface $request);
}
