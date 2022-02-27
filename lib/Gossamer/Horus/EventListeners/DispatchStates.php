<?php

namespace Gossamer\Horus\EventListeners;

class DispatchStates
{
    const STATE_ENTRY_POINT = 'entry_point';

    const STATE_REQUEST_START = 'request_start';

    const STATE_BEGIN_VIEW = 'begin_view';

    const STATE_END_VIEW = 'end_view';

    const STATE_REQUEST_COMPLETE = 'request_complete';

    const STATE_EXIT_POINT = 'exit_point';


}